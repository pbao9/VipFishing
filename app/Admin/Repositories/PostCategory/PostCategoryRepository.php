<?php

namespace App\Admin\Repositories\PostCategory;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface;
use App\Models\PostCategory;

class PostCategoryRepository extends EloquentRepository implements PostCategoryRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return PostCategory::class;
    }
    public function getFlatTreeNotInNode(array $nodeId){
        $this->getQueryBuilderOrderBy('position', 'ASC');
        $this->instance = $this->instance->whereNotIn('id', $nodeId)
        ->withDepth()
        ->get()
        ->toFlatTree();
        return $this->instance;
    }
    public function getFlatTree(){
        $this->getQueryBuilderOrderBy('position', 'ASC');
        $this->instance = $this->instance->withDepth()
        ->get()
        ->toFlatTree();
        return $this->instance;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}