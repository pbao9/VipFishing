<?php

namespace App\Api\V1\Repositories\Slider;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface SliderRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByPlainKeyWithRelations($key, $relations = ['items']);
}