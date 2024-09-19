<?php

namespace App\Api\V1\Repositories\Lakechilds;

use App\Admin\Repositories\Lakechilds\LakechildsRepository as AdminLakechildsRepository;
use App\Api\V1\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Models\Lakechilds;

class LakechildsRepository extends AdminLakechildsRepository implements LakechildsRepositoryInterface
{
    public function getModel()
    {
        return Lakechilds::class;
    }

    public function findByID($id)
    {
        $this->instance = $this->model->where('id', $id)
            ->firstOrFail();

        if ($this->instance && $this->instance->exists()) {
            return $this->instance;
        }

        return null;
    }

    public function getAllLakeChild()
    {
        return $this->model->all();
    }
    public function paginate($page = 1, $limit = 10)
    {
        $page = $page ? $page - 1 : 0;
        $this->instance = $this->model
            ->offset($page * $limit)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();
        return $this->instance;
    }

    public function getLakechildsWithFish()
    {
        return $this->model::with('fish')->get();
    }
}
