<?php

namespace App\Admin\Services\Category;

use App\Admin\Services\Category\CategoryServiceInterface;
use  App\Admin\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;

class CategoryService implements CategoryServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository){
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