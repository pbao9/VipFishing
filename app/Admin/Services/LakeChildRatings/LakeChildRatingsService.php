<?php

namespace App\Admin\Services\LakeChildRatings;

use App\Admin\Services\LakeChildRatings\LakeChildRatingsServiceInterface;
use  App\Admin\Repositories\LakeChildRatings\LakeChildRatingsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LakeChildRatingsService implements LakeChildRatingsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(LakeChildRatingsRepositoryInterface $repository)
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
