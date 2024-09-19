<?php

namespace App\Admin\Services\CloseLakes;

use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Admin\Services\CloseLakes\CloseLakesServiceInterface;
use App\Admin\Repositories\CloseLakes\CloseLakesRepositoryInterface;
use App\Admin\Services\Compensations\CompensationsServiceInterface;
use App\Admin\Repositories\Compensations\CompensationsRepositoryInterface;
use App\Admin\Repositories\Lakechilds\LakechildsRepository;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Enums\Bookings\BookingsFishingStatus;
use App\Enums\Bookings\BookingsPaymentStatus;
use App\Enums\Bookings\BookingsStatus;
use App\Enums\Lakechilds\LakechildsStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CloseLakesService implements CloseLakesServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $compensationService;
    protected $bookingRepository;
    protected $compensationsRepository;
    protected $lakeChildRepo;

    public function __construct(
        CloseLakesRepositoryInterface    $repository,
        CompensationsServiceInterface    $compensationService,
        BookingsRepositoryInterface      $bookingRepository,
        CompensationsRepositoryInterface $compensationsRepository,
        LakechildsRepositoryInterface    $lakeChildRepo,
    ) {
        $this->repository = $repository;
        $this->compensationService = $compensationService;
        $this->bookingRepository = $bookingRepository;
        $this->compensationsRepository = $compensationsRepository;
        $this->lakeChildRepo = $lakeChildRepo;
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        $lakeChild = $this->lakeChildRepo->find($data['lakechild_id']);

        if (isset($data['close_date']) && isset($data['open_date'])) {
            $closeDate = Carbon::parse($data['close_date']);
            $openDate = Carbon::parse($data['open_date']);
            $data['close_days'] = $closeDate->diffInDays($openDate);
        } else {
            $data['close_days'] = 0; // hoặc một giá trị mặc định nếu cần thiết
        }
        $data['canceled_bookings'] = 0;
        $data['total_refund_amount'] = 0;
        $data['compensation_amount'] = 0;
        DB::beginTransaction();
        try {
            $closelake = $this->repository->create($data);
            $lakeChild['status'] = LakechildsStatus::inactive;
            $lakeChild->save();
            $this->updateCancelledBooking($closelake->id);
            $this->updateAffectedBookings($closelake);
            DB::commit();
            return $closelake;
        } catch (\Throwable $th) {
            Log::error('Error storing close lake: ' . $th->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function update(Request $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $oldCloselake = $this->repository->findOrFail($this->data['id']);

            $balance = $this->restoreAffectedBookings($oldCloselake);

            Log::info($balance);

            $closelake = $this->repository->update($this->data['id'], $this->data);
            $this->updateAffectedBookings($closelake, $balance);

            $this->updateCancelledBooking($this->data['id']);

            DB::commit();
            return $closelake;
        } catch (\Throwable $th) {
            Log::error('Error storing close lake: ' . $th->getMessage());
            DB::rollBack();
            return false;
        }
        return $this->repository->update($data['id'], $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function updateCancelledBooking($id)
    {
        $canceled_bookings = 0;
        $total_refund_amount = 0;
        $compensation_amount = 0;
        $closelake = $this->repository->findOrFail($id);
        $bookings = $closelake->lakechild->bookings;
        $closeDate = Carbon::parse($closelake->close_date);
        $closeEndDate = Carbon::parse($closelake->open_date);
        foreach ($bookings as $booking) {
            $fishingDate = Carbon::parse($booking->fishing_date);
            if (
                $fishingDate->gte($closeDate) &&
                $fishingDate->lt($closeEndDate) &&
                ($booking->status == BookingsStatus::Paid || $booking->status == BookingsStatus::Unpaid)
            ) {
                // Chỉ tính các booking có status = 1
                if ($booking->status == BookingsStatus::Paid) {
                    $total_refund_amount += $booking->total_price;
                    $amount = $closelake->lakechild->compensation * $booking->total_price / 100;
                    $compensation_amount += $amount;
                }
                $canceled_bookings += 1;
            }
        }
        $closelake->canceled_bookings = $canceled_bookings;
        $closelake->total_refund_amount = $total_refund_amount;
        $closelake->compensation_amount = $compensation_amount;
        $closelake->save();
        return $closelake;
    }

    protected function updateAffectedBookings($closeLake, $balance = 0)
    {
        $bookings = $closeLake->lakechild->bookings;
        if ($bookings->isEmpty()) {
            return;
        }
        $closeDate = Carbon::parse($closeLake->close_date);
        $closeEndDate = Carbon::parse($closeLake->open_date);
        $affectedBookings = $bookings->filter(function ($booking) use ($closeDate, $closeEndDate) {
            $fishingDate = Carbon::parse($booking->fishing_date);
            return $fishingDate->gte($closeDate) &&
                $fishingDate->lt($closeEndDate) &&
                ($booking->status == BookingsStatus::Paid || $booking->status == BookingsStatus::Unpaid);
        });
        // Duyệt qua các booking bị ảnh hưởng
        foreach ($affectedBookings as $booking) {
            $originalStatus = $booking->status;
            $booking->status = BookingsStatus::Cancelled;
            $booking->save();
            if ($originalStatus == BookingsStatus::Paid) {
                $balance = $booking->user->balance;
                $balance->update(['total_balance' => $balance->total_balance + $booking->total_price]);
                $amountCompensation = $booking->lakechild->compensation * $booking->total_price / 100;
                $compensationData = [
                    "user_id" => $booking->user_id,
                    "amount" => $amountCompensation,
                    "booking_id" => $booking->id,
                ];
                $this->compensationsRepository->create($compensationData);
            }
        }
    }

    public function restoreAffectedBookings($closeLake)
    {
        $bookings = $closeLake->lakechild->bookings->where('fishing_status', '==', BookingsFishingStatus::Cancelled);
        $balance = 0;
        foreach ($bookings as $booking) {
            $booking->fishing_status = BookingsFishingStatus::Completed;
            $booking->save();

            $amountCompensation = $booking->lakechild->compensation * $booking->total_price / 100;
            $balance = $balance - $booking->total_price - $amountCompensation;

            if (!$booking->compensation->delete()) {
                throw new \Exception("Error delete compensation");
            }
        }

        return $balance;
    }
}
