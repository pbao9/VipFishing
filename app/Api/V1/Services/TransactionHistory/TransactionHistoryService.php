<?php

namespace App\Api\V1\Services\TransactionHistory;

use App\Api\V1\Services\TransactionHistory\TransactionHistoryServiceInterface;
use App\Api\V1\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Api\V1\Support\AuthSupport;

class TransactionHistoryService implements TransactionHistoryServiceInterface
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
        TransactionHistoryRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        return (boolean) $this->repository->delete($id);
    }
}