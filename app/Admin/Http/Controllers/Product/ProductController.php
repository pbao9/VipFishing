<?php

namespace App\Admin\Http\Controllers\Product;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Product\ProductRequest;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Admin\DataTables\Product\ProductDataTable;
use App\Enums\Product\ProductType;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Http\Resources\Product\ProductEditResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $repositoryCategory;
    protected $repositoryAttribute;

    public function __construct(
        ProductRepositoryInterface $repository, 
        CategoryRepositoryInterface $repositoryCategory, 
        AttributeRepositoryInterface $repositoryAttribute, 
        ProductServiceInterface $service
    ){
        parent::__construct();
        $this->repository = $repository;
        $this->repositoryCategory = $repositoryCategory;
        $this->repositoryAttribute = $repositoryAttribute;
        $this->service = $service;
    }

    public function getView(){
        return [
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'edit' => 'admin.products.edit',
            'search_render_list' => 'admin.orders.partials.list-search-result-product'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.product.index',
            'create' => 'admin.product.create',
            'edit' => 'admin.product.edit',
            'delete' => 'admin.product.delete'
        ];
    }
    public function index(ProductDataTable $dataTable){
        $inStock = [1 => __('Còn hàng'), 0 => __('Hết hàng')];
        $isUserDiscount = [1 => __('Có'), 0 => __('Không')];
        $categories = $this->repositoryCategory->getFlatTree();
        $categories = $categories->map(function($category){
            return [$category->id => generate_text_depth_tree($category->depth).$category->name];
        });
        return $dataTable->render($this->view['index'], [
            'in_stock' => $inStock,
            'is_user_discount' => $isUserDiscount,
            'categories' => $categories
        ]);
    }

    public function create(){
        $categories = $this->repositoryCategory->getFlatTree();
        $attributes = $this->repositoryAttribute->getAllPluckById();
        return view($this->view['create'], 
            [
                'type' => ProductType::asSelectArray(),
                'categories' => $categories,
                'attributes' => $attributes
            ]
        );
    }

    public function store(ProductRequest $request){

        $instance = $this->service->store($request);
        if($instance){
            return to_route($this->route['edit'], $instance->id);
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id, Request $request){
        
        $product = $this->repository->loadRelations($this->repository->findOrFail($id), [
            'categories:id', 
            'productAttributes' => function($query){
                return $query->with(['attribute.variations', 'attributeVariations:id']);
            }, 
            'productVariations.attributeVariations'
        ]);
        
        $product = new ProductEditResource($product);
        $categories = $this->repositoryCategory->getFlatTree();
        $attributes = $this->repositoryAttribute->getAllPluckById();
        return view(
            $this->view['edit'],
            [
                'product' => (object)$product->toArray($request),
                'type' => ProductType::asSelectArray(),
                'categories' => $categories,
                'attributes' => $attributes
            ]
        );
    }
 
    public function update(ProductRequest $request){

        $instance = $this->service->update($request);

        if($instance){
            return back()->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }

    public function searchRenderProductAndVariation(ProductRequest $request){
        $products = $this->repository->getByColumnsWithRelationsLimit([
            'name' => $request->input('key')
        ]);
        return view($this->view['search_render_list'], compact('products'));
    }

}