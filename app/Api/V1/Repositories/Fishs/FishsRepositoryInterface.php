<?php

namespace App\Api\V1\Repositories\Fishs;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface FishsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function findByIdWithVartiation($id);
}
