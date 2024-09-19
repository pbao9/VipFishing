<?php

namespace App\Admin\Repositories\Order;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Order\OrderDetailRepositoryInterface;
use App\Models\OrderDetail;

class OrderDetailRepository extends EloquentRepository implements OrderDetailRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return OrderDetail::class;
    }
}