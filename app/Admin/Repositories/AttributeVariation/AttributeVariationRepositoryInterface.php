<?php

namespace App\Admin\Repositories\AttributeVariation;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface AttributeVariationRepositoryInterface extends EloquentRepositoryInterface
{
    public function getOrderByFollow(array $arrayId);

    public function findOrFailWithRelations($id , array $relations = []);

    public function getQueryBuilderByColumn($column, $value);
	
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

}