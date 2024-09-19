<?php

namespace App\Admin\Http\Controllers\Role;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Role\RoleRequest;
use App\Admin\Repositories\Role\RoleRepositoryInterface;
use App\Admin\Services\Role\RoleServiceInterface;
use App\Admin\DataTables\Role\RoleDataTable;



class RoleController extends Controller
{
    public function __construct(
        RoleRepositoryInterface $repository, 
        RoleServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.role.index',
            'create' => 'admin.role.create',
            'edit' => 'admin.role.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.role.index',
            'create' => 'admin.role.create',
            'edit' => 'admin.role.edit',
            'delete' => 'admin.role.delete'
        ];
    }
    public function index(RoleDataTable $dataTable){
		
        return $dataTable->render($this->view['index']);
    }

    public function create(){
		$listpermissions = $this->repository->getAllPermissionsNoModule();
		$listmodules = $this->repository->getAllModules();
		
		$listPermissionsInAllModules = $this->repository->getAllPermissionsInAllModules();
		
        return view($this->view['create'],[
			'listpermissions' => $listpermissions,
			'listPermissionsInAllModules' => $listPermissionsInAllModules,
		]);
    }

    public function store(RoleRequest $request){
        $response = $this->service->store($request);
        if($response){
            return to_route($this->route['edit'], $response)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput(); 
    }

    public function edit($id){

        $response = $this->repository->findOrFail($id);
		$permissions = $this->repository->getAllPermissionsNoModule();
		$listPermissionsInAllModules = $this->repository->getAllPermissionsInAllModules();
        return view(
            $this->view['edit'],
            [
                'role' => $response,
				'permissions' => $permissions,
				'listPermissionsInAllModules' => $listPermissionsInAllModules,
            ]
        );

    }
 
    public function update(RoleRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }



}