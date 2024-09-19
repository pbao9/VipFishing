<?php

namespace App\Api\V1\Repositories\Lakechilds;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface LakechildsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function getAllLakeChild();
    public function getLakechildsWithFish();
}
