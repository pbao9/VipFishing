<?php

namespace App\Admin\Http\Controllers\Ranks;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Rank\RankSearchSelectResource;
use App\Admin\Repositories\Ranks\RanksRepositoryInterface;

class RankSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        RanksRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => RankSearchSelectResource::collection($this->instance)
        ];
    }
}