<?php

namespace App\Admin\Http\Controllers\Category;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Category\CategoryRequest;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Services\Category\CategoryServiceInterface;
use App\Admin\DataTables\Category\CategoryDataTable;

class CategoryController extends Controller
{
    public function __construct(
        CategoryRepositoryInterface $repository, 
        CategoryServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;
        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'edit' => 'admin.categories.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.category.index',
            'create' => 'admin.category.create',
            'edit' => 'admin.category.edit',
            'delete' => 'admin.category.delete'
        ];
    }
    public function index(CategoryDataTable $dataTable){
        return $dataTable->render($this->view['index'], [
            'active' => [
                'Hoạt động' => 'Hoạt động',
                'Ẩn' => 'Ẩn'
            ]
        ]);
    }

    public function create(){
        $categories = $this->repository->getFlatTree();
        return view($this->view['create'], ['categories' => $categories]);
    }

    public function store(CategoryRequest $request){

        $instance = $this->service->store($request);

        return to_route($this->route['edit'], $instance->id);

    }

    public function edit($id){
        $categories = $this->repository->getFlatTreeNotInNode([$id]);
        $instance = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'], [
                'category' => $instance,
                'categories' => $categories
            ]
        );
    }

    public function update(CategoryRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}