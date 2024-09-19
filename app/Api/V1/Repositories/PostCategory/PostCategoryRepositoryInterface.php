<?php

namespace App\Api\V1\Repositories\PostCategory;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface PostCategoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByIdWithAncestorsAndDescendants($id);
    public function getTree();
}