<?php

namespace App\Admin\Http\Controllers\Admin;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Admin\AdminRequest;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Admin\Services\Admin\AdminServiceInterface;
use App\Admin\DataTables\Admin\AdminDataTable;

class AdminController extends Controller
{
    public function __construct(
        AdminRepositoryInterface $repository,
        AdminServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        $this->service = $service;

    }

    public function getView(){
        return [
            'index' => 'admin.admins.index',
            'create' => 'admin.admins.create',
            'edit' => 'admin.admins.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.admin.index',
            'create' => 'admin.admin.create',
            'edit' => 'admin.admin.edit',
            'delete' => 'admin.admin.delete'
        ];
    }
    public function index(AdminDataTable $dataTable){
        return $dataTable->render($this->view['index']);
    }

    public function create(){
		$roles = $this->repository->getAllRolesByGuardName('admin');
        return view($this->view['create'], [
			'roles' => $roles
		]);
    }


    public function store(AdminRequest $request){

        $instance = $this->service->store($request);
		$instance->syncRoles($request->roles);

        return to_route($this->route['edit'], $instance->id);

    }

    public function edit($id){

        $instance = $this->repository->findOrFail($id);
		$roles = $this->repository->getAllRolesByGuardName('admin');
        return view(
            $this->view['edit'],
			[
                'admin' => $instance,
				'roles' => $roles,
            ],
        );

    }

    public function update(AdminRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));

    }
}
