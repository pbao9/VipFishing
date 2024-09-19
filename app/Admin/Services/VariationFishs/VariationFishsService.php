<?php

namespace App\Admin\Services\VariationFishs;

use App\Admin\Services\VariationFishs\VariationFishsServiceInterface;
use  App\Admin\Repositories\VariationFishs\VariationFishsRepositoryInterface;
use Illuminate\Http\Request;

class VariationFishsService implements VariationFishsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(VariationFishsRepositoryInterface $repository){
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