<?php

namespace App\Admin\Repositories\FishingRating;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\FishingRating\FishingRatingRepositoryInterface;
use App\Models\FishingRating;

class FishingRatingRepository extends EloquentRepository implements FishingRatingRepositoryInterface
{
    protected $select = [];

    public function getModel(){ // Lấy dữ liệu từ Model FishingRating
        return FishingRating::class;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){ // Lấy các dữ liệu từ Database ra Order By cột id DESC
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}
