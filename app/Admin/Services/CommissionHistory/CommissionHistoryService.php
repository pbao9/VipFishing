<?php

namespace App\Admin\Services\CommissionHistory;

use App\Admin\Services\CommissionHistory\CommissionHistoryServiceInterface;
use App\Admin\Repositories\CommissionHistory\CommissionHistoryRepositoryInterface;
use Illuminate\Http\Request;

class CommissionHistoryService implements CommissionHistoryServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    protected $repository;

    public function __construct(
        CommissionHistoryRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();

        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();

        return (boolean) $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return (boolean) $this->repository->delete($id);
    }

}