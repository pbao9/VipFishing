<?php

namespace App\Admin\Repositories\VariationFishs;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface VariationFishsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

    // public function findOrFail($id);
    public function findOrFailWithRelations($id, $relations = ['fish']);

}