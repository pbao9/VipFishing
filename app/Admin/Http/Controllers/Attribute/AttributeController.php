<?php

namespace App\Admin\Http\Controllers\Attribute;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Attribute\AttributeRequest;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Services\Attribute\AttributeServiceInterface;
use App\Admin\DataTables\Attribute\AttributeDataTable;
use App\Enums\Attribute\AttributeType;

class AttributeController extends Controller
{
    public function __construct(
        AttributeRepositoryInterface $repository, 
        AttributeServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.attributes.index',
            'create' => 'admin.attributes.create',
            'edit' => 'admin.attributes.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.attribute.index',
            'create' => 'admin.attribute.create',
            'edit' => 'admin.attribute.edit',
            'delete' => 'admin.attribute.delete'
        ];
    }
    public function index(AttributeDataTable $dataTable){
        return $dataTable->render($this->view['index'],
            [
                'type' => AttributeType::asSelectArray()
            ]
        );
    }

    public function create(){

        return view($this->view['create'], 
            [
                'type' => AttributeType::asSelectArray()
            ]
        );
    }

    public function store(AttributeRequest $request){

        $instance = $this->service->store($request);
        if($instance){
            return to_route($this->route['index']);
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){
        
        $instance = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'attribute' => $instance,
                'type' => AttributeType::asSelectArray()
            ]
        );

    }
 
    public function update(AttributeRequest $request){

        $this->service->update($request);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}