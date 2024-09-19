<?php

namespace App\Admin\Repositories\Fishs;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface FishsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function getAllFish();
}