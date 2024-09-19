<?php

namespace App\Admin\Repositories\Slider;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface SliderItemRepositoryInterface extends EloquentRepositoryInterface
{
    public function findOrFailWithRelations($id, $relations = ['slider']);
    public function getQueryBuilderByColumns($column, $value);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}