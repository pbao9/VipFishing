<?php

namespace App\Api\V1\Repositories\Post;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface PostRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByPublished($id);
    public function getByCategoriesIdsPaginate(array $categoriesIds, $page = 1, $limit = 10);
    public function paginate($page = 1, $limit = 10);
    public function getFeaturedPaginate($page = 1, $limit = 10);
    public function getRelated($id, $page = 1, $limit = 10);
}