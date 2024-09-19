<?php

namespace App\Admin\Services\BookingLake;

use App\Admin\Services\BookingLake\BookingLakeServiceInterface;
use App\Admin\Repositories\BookingLake\BookingLakeRepositoryInterface;

class BookingLakeService implements BookingLakeServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(
        BookingLakeRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    // public function store(Request $request){
    //     $this->data = $request->validated();
    //     return $this->repository->create($this->data);
    // }

    // public function update(Request $request){

    //     $this->data = $request->validated();

    //     return $this->repository->update($this->data['id'], $this->data);
    // }

    // public function delete($id){
    //     return $this->repository->delete($id);

    // }

}