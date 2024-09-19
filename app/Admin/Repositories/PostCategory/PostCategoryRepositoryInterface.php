<?php

namespace App\Admin\Repositories\PostCategory;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface PostCategoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function getFlatTreeNotInNode(array $nodeId);
    
    public function getFlatTree();
	
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

}