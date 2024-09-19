<?php

namespace App\Api\V1\Repositories\Address;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface ProvinceRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByCode($code);
    public function getAll();
}
