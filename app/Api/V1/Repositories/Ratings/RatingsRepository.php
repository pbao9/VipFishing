<?php

namespace App\Api\V1\Repositories\Ratings;

use App\Admin\Repositories\Ratings\RatingsRepository as AdminRatingsRepository;
use App\Api\V1\Repositories\Ratings\RatingsRepositoryInterface;
use App\Models\Bookings;
use App\Models\Lakechilds;
use App\Models\Ratings;
use Illuminate\Support\Facades\Log;

class RatingsRepository extends AdminRatingsRepository implements RatingsRepositoryInterface
{
    public function getModel()
    {
        return Ratings::class;
    }

    public function findByID($id)
    {
        $this->instance = $this->model->where('id', $id)
            ->firstOrFail();

        if ($this->instance && $this->instance->exists()) {
            return $this->instance;
        }

        return null;
    }

    public function findByLakeID($lake_id)
    {
        $ratings = $this->model
            ->whereHas('booking', function ($query) use ($lake_id) {
                $query->whereHas('lakechild', function ($query) use ($lake_id) {
                    $query->where('lake_id', $lake_id);
                });
            })
            ->get();

        return $ratings;
    }
    public function paginate($page = 1, $limit = 10)
    {
        $page = $page ? $page - 1 : 0;
        $this->instance = $this->model
            ->offset($page * $limit)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();
        return $this->instance;
    }
}
