<?php

namespace App\Api\V1\Repositories\Banks;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface BanksRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function getAll();
}
