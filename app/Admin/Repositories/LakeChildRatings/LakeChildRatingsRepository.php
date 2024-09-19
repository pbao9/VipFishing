<?php

namespace App\Admin\Repositories\LakeChildRatings;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\LakeChildRatings\LakeChildRatingsRepositoryInterface;
use App\Models\Ratings;
use Illuminate\Support\Facades\Log;

class LakeChildRatingsRepository extends EloquentRepository implements LakeChildRatingsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Ratings::class;
    }

    public function getQueryBookingLakeChild($lakechild_id)
    {
        return Ratings::whereHas('booking', function ($query) use ($lakechild_id) {
            $query->where('lakeChild_id', $lakechild_id);
        })
            ->with(['booking.user'])
            ->get()
            ->map(function ($rating) {
                return [
                    'rating' => $rating,
                    'booking' => $rating->booking,
                    'user' => $rating->booking->user,
                ];
            });
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}
