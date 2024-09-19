<?php

namespace App\Admin\Http\Controllers\PostCategory;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\PostCategory\PostCategoryRequest;
use App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface;
use App\Admin\Services\PostCategory\PostCategoryServiceInterface;
use App\Admin\DataTables\PostCategory\PostCategoryDataTable;
use App\Enums\PostCategory\PostCategoryStatus;

class PostCategoryController extends Controller
{
    public function __construct(
        PostCategoryRepositoryInterface $repository, 
        PostCategoryServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;
        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.posts_categories.index',
            'create' => 'admin.posts_categories.create',
            'edit' => 'admin.posts_categories.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.post_category.index',
            'create' => 'admin.post_category.create',
            'edit' => 'admin.post_category.edit',
            'delete' => 'admin.post_category.delete'
        ];
    }
    public function index(PostCategoryDataTable $dataTable){
        return $dataTable->render($this->view['index']);
    }

    public function create(){
        $categories = $this->repository->getFlatTree();

        return view($this->view['create'], [
            'categories' => $categories,
            'status' => PostCategoryStatus::asSelectArray()
        ]);
    }

    public function store(PostCategoryRequest $request){

        $response = $this->service->store($request);

        return to_route($this->route['edit'], $response->id);

    }

    public function edit($id){
        $categories = $this->repository->getFlatTreeNotInNode([$id]);
        
        $category = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'], 
            [
                'category' => $category, 
                'categories' => $categories, 
                'status' => PostCategoryStatus::asSelectArray()
            ], 
        );

    }

    public function update(PostCategoryRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}