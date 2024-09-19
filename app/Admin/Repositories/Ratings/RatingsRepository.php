<?php

namespace App\Admin\Repositories\Ratings;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Ratings\RatingsRepositoryInterface;
use App\Models\Ratings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RatingsRepository extends EloquentRepository implements RatingsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Ratings::class;
    }

    public function existsByBookingId($bookingId)
    {
        return $this->model->where('booking_id', $bookingId)->exists();
    }


    public function getByBookingId($bookingId)
    {
        return $this->model->where('booking_id', $bookingId)->get();
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function existsByUserIdAndLakeId($userId, $lakeId)
    {
        $count = $this->model->whereHas('booking', function ($query) use ($userId, $lakeId) {
            $query->where('user_id', $userId)
                ->whereHas('lakechild', function ($query) use ($lakeId) {
                    $query->where('lake_id', $lakeId);
                });
        })->count();

        return $count;
    }
}
