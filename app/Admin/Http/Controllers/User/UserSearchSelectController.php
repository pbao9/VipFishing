<?php

namespace App\Admin\Http\Controllers\User;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Http\Resources\User\UserSearchSelectResource;

class UserSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    protected function selectResponse()
    {
        $this->instance = [
            'results' => UserSearchSelectResource::collection($this->instance)
        ];
    }
}