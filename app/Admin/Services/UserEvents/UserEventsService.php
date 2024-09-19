<?php

namespace App\Admin\Services\UserEvents;

use App\Admin\Services\UserEvents\UserEventsServiceInterface;
use App\Admin\Repositories\UserEvents\UserEventsRepositoryInterface;
use Illuminate\Http\Request;

class UserEventsService implements UserEventsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(UserEventsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // public function store(Request $request)
    // {

    //     $this->data = $request->validated();
    //     return $this->repository->create($this->data);
    // }

    // public function update(Request $request)
    // {

    //     $this->data = $request->validated();

    //     return $this->repository->update($this->data['id'], $this->data);

    // }

    // public function delete($id)
    // {
    //     return $this->repository->delete($id);

    // }

}