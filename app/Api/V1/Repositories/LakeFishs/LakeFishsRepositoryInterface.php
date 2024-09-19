<?php

namespace App\Api\V1\Repositories\LakeFishs;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface LakeFishsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}