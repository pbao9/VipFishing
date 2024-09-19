<?php

namespace App\Admin\Repositories\Order;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository extends EloquentRepository implements OrderRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Order::class;
    }
    public function findOrFailWithRelations($id, array $relations = ['orderDetails', 'user']){
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }
    public function getQueryBuilderWithRelations($relations = ['user']){
        $this->getQueryBuilder();
        $this->instance = $this->instance->with($relations)->orderBy('id', 'desc');
        return $this->instance;
    }
}