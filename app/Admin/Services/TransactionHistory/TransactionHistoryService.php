<?php

namespace App\Admin\Services\TransactionHistory;

use App\Admin\Services\TransactionHistory\TransactionHistoryServiceInterface;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;

class TransactionHistoryService implements TransactionHistoryServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    protected $repository;

    public function __construct(
        TransactionHistoryRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        return (boolean) $this->repository->delete($id);
    }
}