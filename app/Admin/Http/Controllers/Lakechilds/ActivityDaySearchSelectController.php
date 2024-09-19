<?php

namespace App\Admin\Http\Controllers\Lakechilds;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Lakechilds\ActivityDaySearchSelectResource;
use App\Admin\Repositories\Lakechilds\OperatingRepositoryInterface;

class ActivityDaySearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        OperatingRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    protected function selectResponse()
    {
        $this->instance = [
            'results' => ActivityDaySearchSelectResource::collection($this->instance)
        ];
    }
}
