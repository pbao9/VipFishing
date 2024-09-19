<?php

namespace App\Api\V1\Services\Balances;

use App\Api\V1\Services\Balances\BalancesServiceInterface;
use App\Api\V1\Repositories\Balances\BalancesRepositoryInterface;
use App\Api\V1\Support\AuthSupport;

class BalancesService implements BalancesServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(
        BalancesRepositoryInterface $repository,
    ){
        $this->repository = $repository;
    }

    public function storeFirstTime($id) {
        $data = [
            'user_id' => $id,
            'total_balance' => 0
        ];
        return $this->repository->create($data);
    }
}