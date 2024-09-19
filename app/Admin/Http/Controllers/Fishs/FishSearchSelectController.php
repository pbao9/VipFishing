<?php

namespace App\Admin\Http\Controllers\Fishs;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Fish\FishSearchSelectResource;
use App\Admin\Repositories\Fishs\FishsRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FishSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        FishsRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => FishSearchSelectResource::collection($this->instance)
        ];
    }
}
