<?php

namespace App\Admin\Services\LakeRatings;

use App\Admin\Services\LakeRatings\LakeRatingsServiceInterface;
use  App\Admin\Repositories\LakeRatings\LakeRatingsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LakeRatingsService implements LakeRatingsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(LakeRatingsRepositoryInterface $repository)
    {
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
        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id)
    {
        return $this->repository->delete($id);

    }
}
