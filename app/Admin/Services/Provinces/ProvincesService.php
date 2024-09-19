<?php

namespace App\Admin\Services\Provinces;

use App\Admin\Services\Provinces\ProvinceServiceInterface;
use  App\Admin\Repositories\Provinces\ProvincesRepositoryInterface;
use Illuminate\Http\Request;

class ProvincesService implements ProvinceServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(ProvincesRepositoryInterface $repository){
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