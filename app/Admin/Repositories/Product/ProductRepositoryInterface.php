<?php

namespace App\Admin\Repositories\Product;
use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\Product;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    public function getByIdsAndOrderByIds(array $ids);
    public function getByColumnsWithRelationsLimit(array $data, array $relations = ['productVariations.attributeVariations'], $limit = 10);

    public function getAllByColumns(array $data);

    public function deleteProductAttributes(Product $product);

    public function deleteProductVariations(Product $product);

    public function loadRelations(Product $product, array $relations = []);

    public function attachCategories(Product $product, array $categoriesId);

    public function syncCategories(Product $product, array $categoriesId);
	
    public function getQueryBuilderWithRelations($relations = ['categories', 'productVariations']);

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

}