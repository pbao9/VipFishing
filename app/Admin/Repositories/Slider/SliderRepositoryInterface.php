<?php

namespace App\Admin\Repositories\Slider;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface SliderRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderWithRelations(array $relations = ['items']);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}