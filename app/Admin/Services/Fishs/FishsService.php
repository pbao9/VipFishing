<?php

namespace App\Admin\Services\Fishs;

use App\Admin\Services\Fishs\FishsServiceInterface;
use  App\Admin\Repositories\Fishs\FishsRepositoryInterface;
use Illuminate\Http\Request;

class FishsService implements FishsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(FishsRepositoryInterface $repository){
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