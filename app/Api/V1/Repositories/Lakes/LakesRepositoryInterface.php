<?php

namespace App\Api\V1\Repositories\Lakes;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface LakesRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function getListLakeWithFish();
    public function findByIdWithLakechilds($id);
    public function findAndSearchWithRelation($id = null, array $criteria = [], $orderBy = 'total_rating', $direction = 'desc');
}
