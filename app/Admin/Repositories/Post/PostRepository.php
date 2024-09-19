<?php

namespace App\Admin\Repositories\Post;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Models\Post;

class PostRepository extends EloquentRepository implements PostRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Post::class;
    }
    public function findOrFailWithRelations($id, array $relations = ['categories']){
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }
    
    public function attachCategories(Post $post, array $categoriesId){
        return $post->categories()->attach($categoriesId);
    }

    public function syncCategories(Post $post, array $categoriesId){
        return $post->categories()->sync($categoriesId);
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}