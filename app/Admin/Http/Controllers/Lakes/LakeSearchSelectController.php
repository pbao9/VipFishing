<?php

namespace App\Admin\Http\Controllers\Lakes;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Lake\LakeSearchSelectResource;
use App\Admin\Repositories\Lakes\LakesRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LakeSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        LakesRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => LakeSearchSelectResource::collection($this->instance)
        ];
    }
}
