<?php

namespace App\Admin\Http\Controllers\Product;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Repositories\Product\ProductVariationRepositoryInterface;
use App\Admin\Repositories\AttributeVariation\AttributeVariationRepositoryInterface;
use App\Admin\Http\Requests\Product\ProductVariationRequest;
use App\Enums\Product\ProductVariationAction;
use App\Admin\Traits\Setup;
use App\Admin\Services\Product\ProductServiceInterface;
class ProductVariationController extends Controller
{
    use Setup;
    protected $repositoryAttribute;
    protected $repositoryAttributeVariation;
    
    public function __construct(
        ProductVariationRepositoryInterface $repository,
        AttributeRepositoryInterface $repositoryAttribute,
        AttributeVariationRepositoryInterface $repositoryAttributeVariation,
        ProductServiceInterface $service
    )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->repositoryAttribute = $repositoryAttribute;
        $this->repositoryAttributeVariation = $repositoryAttributeVariation;
        $this->service = $service;
    }

    public function getView()
    {
        return [
            'create' => 'admin.products.data.partials.product-variations',
            'variations' => 'admin.products.data.partials.variations',
            'product_variation' => 'admin.products.data.partials.product-variations',
            'no_variation' => 'admin.products.data.partials.no-variations',
        ];
    }

    public function check(ProductVariationRequest $request){
        return view($this->view['variations'], [
            'actions' => ProductVariationAction::asSelectArray()
        ]);
    }

    public function create(ProductVariationRequest $request){

        if(!in_array($request->input('variation_action'), ProductVariationAction::getValues())){
            return view($this->view['no_variation']);
        }

        $instance = $this->service->createProductVariations($request, $this->view);
        
        return $instance;
    }

    public function delete($id){
        $this->repository->delete($id);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess')
        ], 200);
    }
}