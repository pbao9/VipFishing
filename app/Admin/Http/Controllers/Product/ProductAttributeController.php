<?php

namespace App\Admin\Http\Controllers\Product;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Repositories\Product\ProductAttributeRepositoryInterface;
use App\Admin\Http\Requests\Product\ProductAttributeRequest;

class ProductAttributeController extends Controller
{
    protected $repositoryAttribute;
    
    public function __construct(
        ProductAttributeRepositoryInterface $repository,
        AttributeRepositoryInterface $repositoryAttribute
    )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->repositoryAttribute = $repositoryAttribute;
    }

    public function getView()
    {
        return [
            'create' => 'admin.products.data.partials.product-arttibutes'
        ];
    }

    public function create(ProductAttributeRequest $request){

        $instance = $this->repositoryAttribute->findOrFailWithVariations($request->input('attribute_id'));
        return view($this->view['create'], [
            'attribute' => $instance
        ]);
    }

    public function delete($id){
        $this->repository->delete($id);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess')
        ], 200);
    }
}