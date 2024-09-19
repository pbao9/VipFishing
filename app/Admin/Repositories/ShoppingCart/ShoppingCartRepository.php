<?php

namespace App\Admin\Repositories\ShoppingCart;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Models\ShoppingCart;

class ShoppingCartRepository extends EloquentRepository implements ShoppingCartRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return ShoppingCart::class;
    }
}