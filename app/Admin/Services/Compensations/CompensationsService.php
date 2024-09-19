<?php

namespace App\Admin\Services\Compensations;

use App\Admin\Services\Compensations\CompensationsServiceInterface;
use App\Admin\Repositories\Compensations\CompensationsRepositoryInterface;
use Illuminate\Http\Request;

class CompensationsService implements CompensationsServiceInterface
{
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