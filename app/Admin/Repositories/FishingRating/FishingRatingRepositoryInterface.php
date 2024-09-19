<?php

namespace App\Admin\Repositories\FishingRating;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface FishingRatingRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'); // Lấy các dữ liệu từ Database ra Order By cột id DESC
}
