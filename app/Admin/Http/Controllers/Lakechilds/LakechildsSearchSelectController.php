<?php

namespace App\Admin\Http\Controllers\Lakechilds;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Lakechilds\LakechildsSearchSelectResource;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LakechildsSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        LakechildsRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => LakechildsSearchSelectResource::collection($this->instance)
        ];
    }
}
