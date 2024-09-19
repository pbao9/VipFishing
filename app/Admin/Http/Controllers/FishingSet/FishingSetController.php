<?php

namespace App\Admin\Http\Controllers\FishingSet;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\FishingSet\FishingSetRequest;
use App\Admin\Repositories\FishingSet\FishingSetRepositoryInterface;
use App\Admin\Services\FishingSet\FishingSetServiceInterface;
use App\Admin\DataTables\FishingSet\FishingSetDataTable;


class FishingSetController extends Controller
{
    public function __construct(
        FishingSetRepositoryInterface $repository,
        FishingSetServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;

    }

    public function getView(){
        return [
            'index' => 'admin.fishingSet.index',
            'create' => 'admin.fishingSet.create',
            'edit' => 'admin.fishingSet.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.fishingSet.index',
            'create' => 'admin.fishingSet.create',
            'edit' => 'admin.fishingSet.edit',
            'delete' => 'admin.fishingSet.delete'
        ];
    }
    public function index(FishingSetDataTable $dataTable){
        return $dataTable->render($this->view['index']);
    }

    public function create(){

        return view($this->view['create']);
    }

    public function store(FishingSetRequest $request){

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
                'fishingSet' => $response
            ]
        );

    }

    public function update(FishingSetRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));

    }
}
