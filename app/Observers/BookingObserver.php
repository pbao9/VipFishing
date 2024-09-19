<?php

namespace App\Observers;

use App\Admin\Repositories\BookingLake\BookingLakeRepositoryInterface;
use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Admin\Repositories\Compensations\CompensationsRepositoryInterface;
use App\Admin\Repositories\Deposits\DepositsRepositoryInterface;
use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Admin\Services\Bookings\BookingsServiceInterface;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Admin\Traits\Setup;
use App\Enums\Bookings\BookingsStatus;
use App\Enums\Deposits\DepositsStatus;
use App\Enums\Deposits\DepositType;
use App\Enums\Notifications\NotificationStatus;
use App\Enums\TransactionHistory\TransactionHistoryType;
use App\Models\Bookings;
use Illuminate\Support\Facades\Log;

class BookingObserver
{

    use Setup;
    protected $bookingRepository;
    protected $bookingService;
    protected $bookingLakeRepository;
    protected $compensationRepository;
    protected $notificationRepository;
    protected $transactionHistoryRepository;
    protected $settingRepository;

    protected $depositRepository;

    public function __construct(
        BookingsRepositoryInterface $bookingRepository,
        BookingsServiceInterface $bookingService,
        BookingLakeRepositoryInterface $bookingLakeRepository,
        CompensationsRepositoryInterface $compensationRepository,
        NotificationsRepositoryInterface $notificationRepository,
        TransactionHistoryRepositoryInterface $transactionHistoryRepository,
        SettingRepositoryInterface $settingRepository,
        DepositsRepositoryInterface $depositRepository
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->bookingService = $bookingService;
        $this->bookingLakeRepository = $bookingLakeRepository;
        $this->compensationRepository = $compensationRepository;
        $this->notificationRepository = $notificationRepository;
        $this->transactionHistoryRepository = $transactionHistoryRepository;
        $this->settingRepository = $settingRepository;
        $this->depositRepository = $depositRepository;
    }

    /**
     * Handle the Bookings "created" event.
     *
     * @param  \App\Models\Bookings  $bookings
     * @return void
     */
    public function created(Bookings $booking)
    {
        //
    }

    /**
     * Handle the Bookings "updated" event.
     *
     * @param  \App\Models\Bookings  $bookings
     * @return void
     */
    public function updated(Bookings $booking)
    {
        if ($booking->status == BookingsStatus::Unpaid || $booking->status == BookingsStatus::Cancelled) {
            return;
        }

        // Lấy commission_rate từ setting
        $commission_rate = $this->settingRepository->getValueByKey('commission_rate');
        $commission = ($commission_rate * $booking->total_price) / 100;

        // Lấy tỷ lệ hoa hồng của từng cấp ref
        $referenceKeys = ['reference_fixed', 'reference_1', 'reference_2', 'reference_3'];
        $refCommissionRates = [];

        foreach ($referenceKeys as $key) {
            $refCommissionRates[$key] = $this->settingRepository->getValueByKey($key);
        }

        $user = $booking->user;
        $refUsers = [
            'reference_fixed' => $user->referParent,
            'reference_1' => $user->referParent_1,
            'reference_2' => $user->referParent_2,
            'reference_3' => $user->referParent_3
        ];

        foreach ($refUsers as $level => $referUser) {
            if ($referUser && is_object($referUser)) {
                $rate = $refCommissionRates[$level];
                $commissionForRef = ($commission * $rate) / 100;

                $this->transactionHistoryRepository->create([
                    'user_id' => $referUser->id,
                    'transaction_type' => TransactionHistoryType::Commission,
                    'amount' => $commissionForRef,
                    'balance_after' => optional($referUser->balance)->total_balance + $commissionForRef,
                ]);

                $this->depositRepository->create([
                    'user_id' => $referUser->id,
                    'code' => $this->createCodeBooking(),
                    'status' => DepositsStatus::Pending,
                    'type' => DepositType::moneyCommission,
                    'note' => 'Tiền hoa hồng',
                    'amount' => $commissionForRef
                ]);
            }
        }

        Log::info($booking->bookingLake);
        Log::info("Updated Booking - BookingObserver");

        if ($booking->status == BookingsStatus::Paid && $booking->bookingLake == null) {
            Log::info($booking->bookingLake);

            // Kiểm tra đối tượng user và balance trước khi sử dụng
            if ($booking->user && $booking->user->balance) {
                $balance = $booking->user->balance;
                $balance->update(['total_balance' => $balance->total_balance - $booking->total_price]);

                $this->notificationRepository->create([
                    'title' => 'Thanh toán đơn đặt câu thành công',
                    'content' => 'Số tiền đã thanh toán ' . number_format($booking->total_price, 0, ',', '.') . 'VNĐ',
                    'user_id' => $booking->user_id,
                    'status' => NotificationStatus::Not_Seen
                ]);

                $this->transactionHistoryRepository->create([
                    'user_id' => $booking->user_id,
                    'transaction_type' => TransactionHistoryType::Booking,
                    'amount' => $booking->total_price,
                    'balance_after' => $balance->total_balance,
                ]);

                $variationFish = $this->bookingRepository->getVariationFishOfBooking($booking);

                if (!$variationFish) {
                    Log::error("Không tìm thấy variationFish cho booking ID: {$booking->id}");
                }

                $this->bookingLakeRepository->create([
                    'booking_id' => $booking->id,
                    'variationFishs_id' => $variationFish ? $variationFish->id : null,
                    'total_price' => $booking->total_price,
                ]);
            }
        }

        $isCancelled = $this->bookingService->handleCloseLakeOfBooking($booking);

        if ($isCancelled) {
            // Cập nhật trạng thái hủy Booking
            $booking->status = BookingsStatus::Cancelled;
            $booking->save();

            // Kiểm tra đối tượng user và balance trước khi sử dụng
            if ($booking->user && $booking->user->balance) {
                $balance = $booking->user->balance;
                $balance->update(['total_balance' => $balance->total_balance + $booking->total_price]);

                $this->notificationRepository->create([
                    'title' => 'Hoàn tiền đơn đặt câu bị hủy',
                    'content' => 'Số tiền được nhận ' . number_format($booking->total_price, 0, ',', '.') . 'VNĐ',
                    'user_id' => $booking->user_id,
                    'admin_id' => auth('admin')->user()->id,
                    'status' => NotificationStatus::Not_Seen
                ]);

                $this->transactionHistoryRepository->create([
                    'user_id' => $booking->user_id,
                    'transaction_type' => TransactionHistoryType::Refund,
                    'amount' => $booking->total_price,
                    'balance_after' => $balance->total_balance,
                ]);
            }

            // Kiểm tra đối tượng lakechild trước khi sử dụng
            if ($booking->lakechild) {
                $amountCompensation = $booking->lakechild->compensation * $booking->total_price / 100;
                $this->compensationRepository->create([
                    "user_id" => $booking->user_id,
                    "amount" => $amountCompensation,
                    "booking_id" => $booking->id,
                ]);
            } else {
                Log::error("Không tìm thấy lakechild cho booking ID: {$booking->id}");
            }
        }
    }

    /**
     * Tính và phân bổ hoa hồng cho các cấp giới thiệu
     *
     * @param Bookings $booking
     * @return void
     */
    private function distributeCommissionToRefs(Bookings $booking) {}




    /**
     * Handle the Bookings "deleted" event.
     *
     * @param  \App\Models\Bookings  $bookings
     * @return void
     */
    public function deleted(Bookings $bookings)
    {
        //
    }

    /**
     * Handle the Bookings "restored" event.
     *
     * @param  \App\Models\Bookings  $bookings
     * @return void
     */
    public function restored(Bookings $bookings)
    {
        //
    }

    /**
     * Handle the Bookings "force deleted" event.
     *
     * @param  \App\Models\Bookings  $bookings
     * @return void
     */
    public function forceDeleted(Bookings $bookings)
    {
        //
    }
}
