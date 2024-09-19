<?php

namespace App\Admin\Services\Admin;

use App\Admin\Services\Admin\AdminServiceInterface;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;



class AdminService implements AdminServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(AdminRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){

        $this->data = $request->validated();

        $this->data['password'] = bcrypt($this->data['password']);

        return $this->repository->create($this->data);
    }

    public function update(Request $request){
        
        $this->data = $request->safe()->except(['old_password']);

        if(isset($this->data['password']) && $this->data['password']){
            $this->data['password'] = bcrypt($this->data['password']);
        }else{
            unset($this->data['password']);
        }
		
		$this->repository->syncAdminRoles($this->data['id'],$request->roles);
        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}