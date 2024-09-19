<?php

namespace App\Api\V1\Repositories\Address;

use App\Admin\Repositories\Provinces\ProvincesRepository as AdminBanksRepository;
use App\Api\V1\Repositories\Address\ProvinceRepositoryInterface;
use App\Models\Province;

class ProvinceRepository extends AdminBanksRepository implements ProvinceRepositoryInterface
{
    public function getModel()
    {
        return Province::class;
    }

    public function findByCode($code)
    {
        $this->instance = $this->model->where('code', $code)
            ->firstOrFail();

        if ($this->instance && $this->instance->exists()) {
            return $this->instance;
        }

        return null;
    }

    public function getAll()
    {
        $this->instance = $this->model->all();
        return $this->instance;
    }
}
