<?php

namespace App\Admin\Repositories\Bookings;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Enums\Bookings\BookingsStatus;
use App\Models\Bookings;
use App\Models\FishingSet;
use App\Models\Lakechilds;

class BookingsRepository extends EloquentRepository implements BookingsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Bookings::class;
    }

    public function getByStatus($status)
    {
        return $this->model->where('status', $status)->get();
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['*'], $limit = 10)
    {
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where('total_price', 'LIKE', '%' . $key . '%');

        $this->instance = $this->instance->orWhereHas('lakeChild', function ($query) use ($key) {
            return $query->where('name', 'LIKE', '%' . $key . '%');
        });
    }

    public function getVariationFishOfBooking($booking)
    {
        try {
            $lakeChild = $booking->lakechild;

            $fishDensity = doubleval($lakeChild->fish_density);

            $variationFish = $lakeChild->fish->variationFishes;

            $variationFishOfBooking = $variationFish->filter(function ($item) use ($fishDensity) {
                return $fishDensity >= $item->fish_density;
            })->sortByDesc('fish_density')->firstOrFail();

            return $variationFishOfBooking;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function calculateTotalPrice($data)
    {
        $lakeChild = Lakechilds::with('fish.variationFishes')->find($data['lakeChild_id']);

        if (!$lakeChild) {
            throw new \Exception('LakeChild not found');
        }

        $fishingSet = FishingSet::find($data['fishingset_id']);

        if (!$fishingSet) {
            throw new \Exception('FishingSet not found');
        }

        $fishDensity = doubleval($lakeChild->fish_density);
        $variationFish = $lakeChild->fish->variationFishes;

        $basePrice = $variationFish->filter(function ($item) use ($fishDensity) {
            return $fishDensity >= $item->fish_density;
        })->sortByDesc('fish_density')->first()->fish_price ?? 0;

        // Sáng chiều tặng 1 tiếng
        // Cả ngày tặng 2 tiếng
        $duration = $fishingSet->duration;


        // Áp dụng điều chỉnh vào duration
        if ($duration >= 10) {
            $duration -= 2;
        } elseif ($duration == 5) {
            $duration -= 1;
        }

        $totalPrice = $basePrice * $fishDensity * $duration;

        return $totalPrice;
    }

    public function hasPendingOrder($userId)
    {
        return $this->model->where('user_id', $userId)
            ->where('status', BookingsStatus::Unpaid)
            ->exists();
    }

    public function getBookedPositions($lakechildId, $fishingsetId, $fishingDate)
    {
        return $this->model->where('lakeChild_id', $lakechildId)
            ->where('fishingset_id', $fishingsetId)
            ->whereDate('fishing_date', $fishingDate)
            ->whereNotIn('status', [BookingsStatus::Completed, BookingsStatus::Cancelled])
            ->pluck('position')
            ->toArray();
    }
}
