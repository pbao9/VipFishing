<?php

namespace App\Admin\Services\Bookings;

use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Admin\Services\Bookings\BookingsServiceInterface;
use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Admin\Repositories\User\UserRepository;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Services\CloseLakes\CloseLakesServiceInterface;
use App\Admin\Traits\Setup;
use App\Enums\Bookings\BookingsStatus;
use App\Enums\Notifications\NotificationStatus;
use App\Models\ActivitySchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsService implements BookingsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    use Setup;
    protected $data;

    protected $repository;
    protected $lakeChildRepository;
    protected $closeLakeService;
    protected $notificationRepository;
    protected $userRepository;

    public function __construct(
        BookingsRepositoryInterface $repository,
        LakechildsRepositoryInterface $lakeChildRepository,
        CloseLakesServiceInterface $closeLakeService,
        NotificationsRepositoryInterface $notificationRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->repository = $repository;
        $this->lakeChildRepository = $lakeChildRepository;
        $this->closeLakeService = $closeLakeService;
        $this->notificationRepository = $notificationRepository;
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();

        // Kiểm tra nếu người dùng có đơn hàng chưa thanh toán
        // if ($this->repository->hasPendingOrder($this->data['user_id'])) {
        //     return [
        //         'success' => false,
        //         'message' => __('unpaidOtherBooking')
        //     ];
        // }

        // Tìm lakechild và kiểm tra số lượng slot
        $lakechild = $this->lakeChildRepository->find($this->data['lakeChild_id']);
        $lakeSlots = $lakechild->slot;

        // Lấy danh sách các ngày hoạt động của hồ con trong tháng từ ActivitySchedule
        $activitySchedule = ActivitySchedule::where('lake_child_id', $lakechild->id)
            ->where('activity_date', $this->data['fishing_date']) // Kiểm tra ngày hoạt động với ngày đặt
            ->first();


        $check = $activitySchedule->checkIfLakeClosed();

        // Nếu không có ngày hoạt động nào khớp với ngày đặt
        if (!$check) {
            return [
                'success' => false,
                'message' => __('Hồ câu hiện đang tạm ngưng') // Thông báo rằng hồ không hoạt động vào ngày này
            ];
        }

        // Nếu không có ngày hoạt động nào khớp với ngày đặt
        if (!$activitySchedule) {
            return [
                'success' => false,
                'message' => __('fishingDayNotAvailable') // Thông báo rằng hồ không hoạt động vào ngày này
            ];
        }

        // Kiểm tra vị trí đặt trước đó
        $existingPositions = $this->repository->getBookedPositions($lakechild->id, $this->data['fishingset_id'], $this->data['fishing_date']);
        $availablePositions = array_diff(range(1, $lakeSlots), $existingPositions);

        if (empty($availablePositions)) {
            return [
                'success' => false,
                'message' => __('noSlotsAvailable'),
            ];
        }

        // Chọn một vị trí ngẫu nhiên từ các vị trí còn trống
        $this->data['position'] = $availablePositions[array_rand($availablePositions)];
        $this->data['status'] = BookingsStatus::Unpaid;
        $this->data['total_price'] = $this->repository->calculateTotalPrice($this->data);

        // $user = User::find($this->data['user_id']);
        $user = $this->userRepository->find($this->data['user_id']);
        if (!$user) {
            return [
                'success' => false,
                'message' => __('userNotFound')
            ];
        }

        // Kiểm tra số dư của người dùng
        if ($user->balance->total_balance < $this->data['total_price']) {
            return [
                'success' => false,
                'message' => __('insufficientBalance')
            ];
        }

        // Tạo đơn đặt hàng
        $this->data['booking_code'] = $this->createCodeBooking();
        $result = $this->repository->create($this->data);

        if ($result) {
            return [
                'id' => $result->id,
                'success' => true,
                'message' => __('notifyBookingSuccess')
            ];
        } else {
            return [
                'success' => false,
                'message' => __('notifyFail')
            ];
        }
    }


    public function update(Request $request)
    {
        $this->data = $request->validated();
        $this->data['total_price'] = $this->repository->calculateTotalPrice($this->data);

        $booking = $this->repository->find($this->data['id']);

        $balance = $booking->user->balance;

        if ($this->data['status'] != BookingsStatus::Unpaid && $this->data['status'] != BookingsStatus::Cancelled) {
            // Nếu đã thanh toán và không có sự thay đổi trạng thái
            if ($this->data['status'] == $booking->status)
                return [
                    'success' => true,
                    'message' => __('notifySuccess')
                ];

            if ($this->data['status'] == BookingsStatus::Paid) {
                if ($booking->status == BookingsStatus::Unpaid) {
                    if ($balance->total_balance < $this->data['total_price']) {
                        $this->notificationRepository->create([
                            'title' => 'Thanh toán đơn đặt câu thất bại',
                            'content' => 'Không đủ số dư. Số dư hiện tại ' . number_format($balance->total_balance, 0, ',', '.') . 'VNĐ',
                            'user_id' => $booking->user_id,
                            'admin_id' => auth('admin')->user()->id,
                            'status' => NotificationStatus::Not_Seen
                        ]);
                        return [
                            'success' => false,
                            'message' => __('insufficientBalance')
                        ];
                    }
                }
            } elseif ($booking->status == BookingsStatus::Unpaid) {
                // Nếu chưa thanh toán thì phải thanh toán
                return [
                    'success' => false,
                    'message' => __('unpaidThisBooking')
                ];
            }
        } else {
            if ($booking->status != BookingsStatus::Unpaid) {
                return [
                    'success' => false,
                    'message' => __('paidThisBooking')
                ];
            }
        }

        $result = $this->repository->update($this->data['id'], $this->data);

        if ($result) {
            return [
                'success' => true,
                'message' => __('notifySuccess')
            ];
        } else {
            return [
                'success' => false,
                'message' => __('notifyFail')
            ];
        }
    }

    public function delete($id)
    {
        return (bool) $this->repository->update($id, ['status' => BookingsStatus::Cancelled]);
    }

    public function handleCloseLakeOfBooking($booking)
    {
        try {
            $isCancelled = false;

            $lakeChild = $booking->lakechild;
            $fishingDate = Carbon::parse($booking->fishing_date);

            $closeLakes = $lakeChild->closeLakes->sortBy(function ($closeLake) {
                return Carbon::parse($closeLake->close_date);
            });

            foreach ($closeLakes as $closeLake) {
                $closeDate = Carbon::parse($closeLake->close_date);
                $closeEndDate = $closeDate->copy()->addDays($closeLake->close_days - 1);

                if ($fishingDate->between($closeDate, $closeEndDate)) {
                    $isCancelled = true;
                }
                if (!$this->closeLakeService->updateCancelledBooking($closeLake->id)) {
                    throw new \Exception("Error update closeLake");
                }
            }

            return $isCancelled;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
