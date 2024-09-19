<?php

namespace App\Admin\Services\Attribute;

use App\Admin\Services\Attribute\AttributeServiceInterface;
use  App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use Illuminate\Http\Request;

class AttributeService implements AttributeServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(AttributeRepositoryInterface $repository){
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