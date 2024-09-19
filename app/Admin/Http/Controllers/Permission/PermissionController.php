<?php

namespace App\Admin\Http\Controllers\Permission;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Permission\PermissionRequest;
use App\Admin\Repositories\Permission\PermissionRepositoryInterface;
use App\Admin\Services\Permission\PermissionServiceInterface;
use App\Admin\DataTables\Permission\PermissionDataTable;



class PermissionController extends Controller
{
    public function __construct(
        PermissionRepositoryInterface $repository, 
        PermissionServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.permission.index',
            'create' => 'admin.permission.create',
            'edit' => 'admin.permission.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.permission.index',
            'create' => 'admin.permission.create',
            'edit' => 'admin.permission.edit',
            'delete' => 'admin.permission.delete'
        ];
    }
    public function index(PermissionDataTable $dataTable){
		
        return $dataTable->render($this->view['index']);
    }

    public function create(){
		$listmodules = $this->repository->getAllModules();
        return view($this->view['create'], [
			'listmodules' => $listmodules
		]);
    }

    public function store(PermissionRequest $request){
		// $role = Role::create(['name' => 'coolngauuuu' , 'title' => 'asdsadsa']);
        $response = $this->service->store($request);
        if($response){
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput(); 
    }

    public function edit($id){
		$listmodules = $this->repository->getAllModules();
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
				'listmodules' => $listmodules,
                'permission' => $response
            ]
        );

    }
 
    public function update(PermissionRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}