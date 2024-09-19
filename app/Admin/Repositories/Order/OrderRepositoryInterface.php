<?php

namespace App\Admin\Repositories\Order;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface OrderRepositoryInterface extends EloquentRepositoryInterface
{
	public function findOrFailWithRelations($id, array $relations = ['orderDetails', 'user']);
	public function getQueryBuilderWithRelations($relations = ['user']);
}