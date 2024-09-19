<?php

namespace App\Api\V1\Repositories\Fishs;

use App\Admin\Repositories\Fishs\FishsRepository as AdminFishsRepository;
use App\Api\V1\Repositories\Fishs\FishsRepositoryInterface;
use App\Models\Fishs;

class FishsRepository extends AdminFishsRepository implements FishsRepositoryInterface
{
    public function getModel()
    {
        return Fishs::class;
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


    public function findByIdWithVartiation($id)
    {
        return $this->model::with(['variationFishes'])->findOrFail($id);
    }


    public function paginate($page = 1, $limit = 10, $search = "")
    {
        $page = $page ? $page - 1 : 0;
        $query = $this->model->orderBy('id', 'desc');

        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $this->instance = $query->offset($page * $limit)
            ->limit($limit)
            ->get();

        return $this->instance;
    }
}
