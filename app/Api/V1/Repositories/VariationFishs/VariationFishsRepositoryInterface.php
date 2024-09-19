<?php

namespace App\Api\V1\Repositories\VariationFishs;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface VariationFishsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}