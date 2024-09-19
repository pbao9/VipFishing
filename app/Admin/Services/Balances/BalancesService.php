<?php

namespace App\Admin\Services\Balances;

use App\Admin\Services\Balances\BalancesServiceInterface;
use App\Admin\Repositories\Balances\BalancesRepositoryInterface;

class BalancesService implements BalancesServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(BalancesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function storeFirstTime($id)
    {
        $data = [
            'user_id' => $id,
            'total_balance' => 0
        ];
        return $this->repository->create($data);
    }
}