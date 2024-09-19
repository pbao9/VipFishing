<?php

namespace App\Admin\Http\Controllers\LakeFishs;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\LakeFishs\LakeFishsRequest;
use App\Admin\Repositories\LakeFishs\LakeFishsRepositoryInterface;
use App\Admin\Services\LakeFishs\LakeFishsServiceInterface;
use App\Admin\DataTables\LakeFishs\LakeFishsDataTable;
use Illuminate\Support\Facades\DB;

class LakeFishsController extends Controller
{
    public function __construct(
        LakeFishsRepositoryInterface $repository,
        LakeFishsServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;

    }

    public function getView(){
        return [
            'index' => 'admin.lakeFishs.index',
            'create' => 'admin.lakeFishs.create',
            'edit' => 'admin.lakeFishs.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.lakeFishs.index',
            'create' => 'admin.lakeFishs.create',
            'edit' => 'admin.lakeFishs.edit',
            'delete' => 'admin.lakeFishs.delete'
        ];
    }
    public function index(LakeFishsDataTable $dataTable){
        return $dataTable->render($this->view['index']);
    }

    public function create(){
        return view($this->view['create']);
    }

    public function store(LakeFishsRequest $request){
        $response = $this->service->store($request);
        if($response){
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){
        $response = $this->repository->getBy(["id" =>$id] , ['lake_child', 'fish'])->first();
        return view(
            $this->view['edit'],
            [
                'lakeFishs' => $response
            ]
        );

    }

    public function update(LakeFishsRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));

    }
}
