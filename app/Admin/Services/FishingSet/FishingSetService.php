<?php

namespace App\Admin\Services\FishingSet;

use App\Admin\Services\FishingSet\FishingSetServiceInterface;
use  App\Admin\Repositories\FishingSet\FishingSetRepositoryInterface;
use Illuminate\Http\Request;

class FishingSetService implements FishingSetServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(FishingSetRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){

        $this->data = $request->validated();
        return $this->repository->create($this->data);
    }

    public function update(Request $request){
        
        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}