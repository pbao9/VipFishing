<?php

namespace App\Admin\Http\Controllers\Banks;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Bank\BankSearchSelectResource;
use App\Admin\Repositories\Banks\BanksRepositoryInterface;

class BankSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        BanksRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => BankSearchSelectResource::collection($this->instance)
        ];
    }
}