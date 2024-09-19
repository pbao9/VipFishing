<?php

namespace App\Admin\Services\Module;

use App\Admin\Services\Module\ModuleServiceInterface;
use  App\Admin\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Module;
use Spatie\Permission\Models\Permission;


class ModuleService implements ModuleServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(ModuleRepositoryInterface $repository){
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