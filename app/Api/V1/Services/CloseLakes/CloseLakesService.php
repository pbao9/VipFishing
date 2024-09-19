<?php

namespace App\Api\V1\Services\CloseLakes;

use App\Api\V1\Repositories\Bookings\BookingsRepositoryInterface;
use App\Api\V1\Repositories\CloseLakes\CloseLakesRepositoryInterface;
use App\Api\V1\Services\Compensations\CompensationsServiceInterface;
use App\Enums\Bookings\BookingsFishingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


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

    public function __construct(
        CloseLakesRepositoryInterface $repository,
        CompensationsServiceInterface $compensationService,
        BookingsRepositoryInterface   $bookingRepository
    )
    {
        $this->repository = $repository;
        $this->compensationService = $compensationService;
        $this->bookingRepository = $bookingRepository;
    }

    public function add(Request $request)
    {
        $data = $request->validated();
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
            $this->updateCancelledBooking($closelake->id);
            $this->updateAffectedBookings($closelake);
            DB::commit();
            return $closelake;

        } catch (\Throwable $th) {
            \Log::error('Error storing close lake: ' . $th->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function edit(Request $request)
    {
        $this->data = $request->validated();

        DB::beginTransaction();
        try {
            $oldCloselake = $this->repository->findOrFail($this->data['id']);

            $balance = $this->restoreAffectedBookings($oldCloselake);

            \Log::info($balance);

            $closelake = $this->repository->update($this->data['id'], $this->data);
            $this->updateAffectedBookings($closelake, $balance);

            $this->updateCancelledBooking($this->data['id']);

            DB::commit();
            return $closelake;

        } catch (\Throwable $th) {
            \Log::error('Error storing close lake: ' . $th->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function delete(Request $request)
    {
        $this->data = $request->validated();
        try {
            $this->repository->delete($this->data['id']);
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function updateCancelledBooking($id)
    {
        $closelake = $this->repository->findOrFail($id);

        $canceled_bookings = 0;
        $total_refund_amount = 0;
        $compensation_amount = 0;
        $bookings = $closelake->lakechild->bookings;

        $closeDate = Carbon::parse($closelake->close_date);
        $closeEndDate = $closeDate->copy()->addDays($closelake->close_days - 1);
        foreach ($bookings as $booking) {
            $fishingDate = Carbon::parse($booking->fishing_date);
            if ($fishingDate->between($closeDate, $closeEndDate)) {

                $canceled_bookings += 1;
                $amount = $closelake->lakechild->compensation * $booking->total_price / 100;
                $compensation_amount += $amount;
                $total_refund_amount += $booking->total_price;
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
        $bookings = $closeLake->lakechild->bookings->where('fishing_status', '!=', BookingsFishingStatus::Cancelled);
        $closeDate = Carbon::parse($closeLake->close_date);
        $closeEndDate = $closeDate->copy()->addDays($closeLake->close_days - 1);
        $newBalance = 0;

        foreach ($bookings as $booking) {
            $fishingDate = Carbon::parse($booking->fishing_date);

            if ($fishingDate->between($closeDate, $closeEndDate)) {

                $booking->fishing_status = BookingsFishingStatus::Cancelled;
                $booking->save();

                $newBalance += $booking->total_price;

                $amountCompensation = $booking->lakechild->compensation * $booking->total_price / 100;
                $compensation = $booking->compensation;
                if ($compensation) {
                    $compensation->amount = $amountCompensation;
                    $compensation->user_id = $booking->user_id;
                    if (!$this->compensationService->updateCompensation($compensation->toArray())) {
                        throw new \Exception("Error update compensation");
                    }
                } else {
                    $compensationData = [
                        "user_id" => $booking->user_id,
                        "amount" => $amountCompensation,
                        "booking_id" => $booking->id,
                    ];
                    if (!$this->compensationService->storeCompensation($compensationData)) {
                        throw new \Exception("Error save compensation");
                    }
                }
            }
        }
        $newBalance = $booking->user->balance->total_balance + $newBalance + $balance;
        \Log::info($newBalance);
        $this->bookingRepository->updateBalanceUserBooking($booking, $newBalance);
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
