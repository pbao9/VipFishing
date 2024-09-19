<?php

namespace App\Admin\Http\Controllers\Provinces;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Provinces\ProvincesSearchSelectResource;
use App\Admin\Repositories\Provinces\ProvincesRepositoryInterface;
class ProvincesSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        ProvincesRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => ProvincesSearchSelectResource::collection($this->instance)
        ];
    }
}
