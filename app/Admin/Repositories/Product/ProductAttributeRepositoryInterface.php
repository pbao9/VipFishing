<?php

namespace App\Admin\Repositories\Product;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface ProductAttributeRepositoryInterface extends EloquentRepositoryInterface
{
    public function createOrUpdateWithVariation($product_id, array $productAttribute);
	
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}