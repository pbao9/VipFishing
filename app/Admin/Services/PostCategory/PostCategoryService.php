<?php

namespace App\Admin\Services\PostCategory;

use App\Admin\Services\PostCategory\PostCategoryServiceInterface;
use  App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface;
use Illuminate\Http\Request;

class PostCategoryService implements PostCategoryServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(PostCategoryRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){

        $this->data = $request->validated();

        return $this->repository->create($this->data);
    }

    public function update(Request $request){
        
        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}