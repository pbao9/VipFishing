<?php

namespace App\Api\V1\Repositories\PostCategory;
use App\Admin\Repositories\PostCategory\PostCategoryRepository as AdminPostCategoryRepository;
use App\Api\V1\Repositories\PostCategory\PostCategoryRepositoryInterface;

class PostCategoryRepository extends AdminPostCategoryRepository implements PostCategoryRepositoryInterface
{
    public function getTree(){
        $this->instance = $this->model->published()
        ->orderBy('position', 'ASC')
        ->get()
        ->toTree();
        
        return $this->instance;
    }

    public function findByIdWithAncestorsAndDescendants($id){
        $this->findOrFail($id);

        $this->instance = $this->instance->load([
            'ancestors' => function($query) {
                $query->defaultOrder();
            },
            'descendants'
        ]);
        return $this->instance;

    }
}