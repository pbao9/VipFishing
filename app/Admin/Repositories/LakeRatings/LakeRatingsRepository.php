<?php

namespace App\Admin\Repositories\LakeRatings;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\LakeRatings\LakeRatingsRepositoryInterface;
use App\Models\Ratings;

class LakeRatingsRepository extends EloquentRepository implements LakeRatingsRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Ratings::class;
    }
    public function getQueryBookingLake($lake_id)
    {
        return Ratings::whereHas('booking.lakechild', function ($query) use ($lake_id) {
            $query->where('lake_id', $lake_id);
        })
        ->with(['booking.user', 'booking.lakechild.lake']) // Eager load lake relationship
        ->get()
        ->map(function ($rating) {
            return [
                'rating' => $rating,
                'booking' => $rating->booking,
                'user' => $rating->booking->user,
                'lake' => $rating->booking->lakechild->lake, // Include lake details
            ];
        });
    }
    

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}
