<?php

namespace App\Admin\Http\Controllers\AttributeVariation;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\AttributeVariation\AttributeVariationRequest;
use App\Admin\Repositories\AttributeVariation\AttributeVariationRepositoryInterface;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Services\AttributeVariation\AttributeVariationServiceInterface;
use App\Admin\DataTables\AttributeVariation\AttributeVariationDataTable;
use App\Enums\Attribute\AttributeType;

class AttributeVariationController extends Controller
{
    protected $repositoryAttribute;

    public function __construct(
        AttributeVariationRepositoryInterface $repository, 
        AttributeRepositoryInterface $repositoryAttribute, 
        AttributeVariationServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;
        $this->repositoryAttribute = $repositoryAttribute;
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.variations.index',
            'create' => 'admin.variations.create',
            'edit' => 'admin.variations.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.attribute.variation.index',
            'create' => 'admin.attribute.variation.create',
            'edit' => 'admin.attribute.variation.edit',
            'delete' => 'admin.attribute.variation.delete'
        ];
    }
    public function index($attribute_id, AttributeVariationDataTable $dataTable){
        $attribute = $this->repositoryAttribute->findOrFail($attribute_id);
        return $dataTable->with('attribute', $attribute)->render($this->view['index'], [
            'attribute' => $attribute
        ]);
    }

    public function create($attribute_id){
        $instance = $this->repositoryAttribute->findOrFail($attribute_id);
        return view($this->view['create'], 
            [
                'attribute' => $instance,
                'has_meta_value_color' => $instance->type == AttributeType::Color()
            ]
        );
    }

    public function store(AttributeVariationRequest $request){

        $instance = $this->service->store($request);
        if($instance){
            return to_route($this->route['index'], $instance->attribute_id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){
        
        $instance = $this->repository->findOrFailWithRelations($id);
        return view(
            $this->view['edit'],
            [
                'variation' => $instance,
                'has_meta_value_color' => optional($instance->attribute)->type == AttributeType::Color()
            ]
        );

    }
 
    public function update(AttributeVariationRequest $request){

        $instance = $this->service->update($request);
        if($instance){
            return to_route($this->route['index'], $instance->attribute_id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();

    }

    public function delete($attribute_id, $id){

        $this->service->delete($id);
        
        return to_route($this->route['index'], $attribute_id)->with('success', __('notifySuccess'));
        
    }
}