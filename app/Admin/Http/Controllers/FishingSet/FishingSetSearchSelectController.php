<?php

namespace App\Admin\Http\Controllers\FishingSet;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\FishingSet\FishingSetSearchSelectResource;
use App\Admin\Repositories\FishingSet\FishingSetRepositoryInterface;

class FishingSetSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        FishingSetRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => FishingSetSearchSelectResource::collection($this->instance)
        ];
    }
}