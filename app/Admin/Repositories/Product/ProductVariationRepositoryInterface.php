<?php

namespace App\Admin\Repositories\Product;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface ProductVariationRepositoryInterface extends EloquentRepositoryInterface
{
    public function getByIdsAndOrderByIdsWithRelations(array $id, array $relations = ['product']);
    public function createOrUpdateWithVariation($product_id, array $ProductVariation);
	
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}