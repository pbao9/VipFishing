<?php

namespace App\Admin\Services\Deposits;

use App\Admin\Services\Deposits\DepositsServiceInterface;
use App\Admin\Repositories\Deposits\DepositsRepositoryInterface;
use App\Admin\Traits\Setup;
use App\Enums\Deposits\DepositsStatus;
use Illuminate\Http\Request;

class DepositsService implements DepositsServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    protected $repository;

    public function __construct(
        DepositsRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $this->data['code'] = $this->createCodeUser();
        $this->data['status'] = DepositsStatus::Pending;
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;

        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;

        return (boolean) $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return (boolean) $this->repository->delete($id);
    }

}