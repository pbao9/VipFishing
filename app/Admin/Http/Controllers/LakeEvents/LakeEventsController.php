<?php

namespace App\Admin\Http\Controllers\LakeEvents;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\LakeEvents\LakeEventsRequest;
use App\Admin\Repositories\LakeEvents\LakeEventsRepositoryInterface;
use App\Admin\Services\LakeEvents\LakeEventsServiceInterface;
use App\Admin\DataTables\LakeEvents\LakeEventsDataTable;


class LakeEventsController extends Controller
{
    public function __construct(
        LakeEventsRepositoryInterface $repository, 
        LakeEventsServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.lakeEvents.index',
            'create' => 'admin.lakeEvents.create',
            'edit' => 'admin.lakeEvents.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.lakeEvents.index',
            'create' => 'admin.lakeEvents.create',
            'edit' => 'admin.lakeEvents.edit',
            'delete' => 'admin.lakeEvents.delete'
        ];
    }
    public function index(LakeEventsDataTable $dataTable){
        return $dataTable->render($this->view['index']);
    }

    public function create(){

        return view($this->view['create']);
    }

    public function store(LakeEventsRequest $request){

        $response = $this->service->store($request);
        if($response){
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'lakeEvents' => $response
            ]
        );

    }
 
    public function update(LakeEventsRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}