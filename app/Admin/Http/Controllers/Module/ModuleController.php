<?php

namespace App\Admin\Http\Controllers\Module;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Module\ModuleRequest;
use App\Admin\Repositories\Module\ModuleRepositoryInterface;
use App\Admin\Services\Module\ModuleServiceInterface;
use App\Admin\DataTables\Module\ModuleDataTable;
use App\Enums\Module\ModuleStatus;


class ModuleController extends Controller
{
    public function __construct(
        ModuleRepositoryInterface $repository, 
        ModuleServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.module.index',
            'summary' => 'admin.module.summary',
            'create' => 'admin.module.create',
            'edit' => 'admin.module.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.module.index',
            'summary' => 'admin.module.summary',
            'create' => 'admin.module.create',
            'edit' => 'admin.module.edit',
            'delete' => 'admin.module.delete'
        ];
    }
    public function index(ModuleDataTable $dataTable){	
        return $dataTable->render($this->view['index']);
    }


	public function summary(){
		$listmodules = $this->repository->getAllModulesWithPermissions();
        return view($this->view['summary'], [
			'listmodules' => $listmodules
		]);
    }
	


    public function create(){
		$listpermissions = $this->repository->getAllPermissions();
        return view($this->view['create'], [
			'listpermissions' => $listpermissions,
			'status' => ModuleStatus::asSelectArray()
		]);
    }

    public function store(ModuleRequest $request){
        $response = $this->service->store($request);
        if($response){
            return to_route($this->route['edit'], $response)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput(); 
    }

    public function edit($id){
        $response = $this->repository->findOrFail($id);
		$listpermissions = $this->repository->getAllPermissionsOfTheModule($id);
        return view(
            $this->view['edit'],
            [
                'module' => $response,
				'listpermissions' => $listpermissions,
				'status' => ModuleStatus::asSelectArray()
            ]
        );

    }
 
    public function update(ModuleRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }



}