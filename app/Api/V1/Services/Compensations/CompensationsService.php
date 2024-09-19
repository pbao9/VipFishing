<?php

namespace App\Api\V1\Services\Compensations;

use App\Api\V1\Services\Compensations\CompensationsServiceInterface;
use App\Api\V1\Repositories\Compensations\CompensationsRepositoryInterface;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;

class CompensationsService implements CompensationsServiceInterface
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
        CompensationsRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function add(Request $request)
    {
        $this->data = $request->validated();

        return $this->repository->create($this->data);
    }

    public function edit(Request $request)
    {
        $this->data = $request->validated();

        return (boolean) $this->repository->update($this->data['id'], $this->data);
    }

    public function delete(Request $request)
    {
        $this->data = $request->validated();
        return (boolean) $this->repository->delete($this->data['id']);
    }
}