<?php

namespace App\Admin\Services\Post;

use App\Admin\Services\Post\PostServiceInterface;
use  App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Enums\Post\PostType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostService implements PostServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(PostRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){

        $this->data = $request->validated();
        $this->data['post_type'] = PostType::Default;
        $this->data['posted_at'] = now();
        $categoriesId = $this->data['categories_id'];
        unset($this->data['categories_id']);
        DB::beginTransaction();
        try {
            $post = $this->repository->create($this->data);

            $this->repository->attachCategories($post, $categoriesId ?? []);
            DB::commit();
            return $post;
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return false;
        }
    }

    public function update(Request $request){
        
        $this->data = $request->validated();
        $this->data['is_featured'] = $this->data['is_featured'] ?? false;
        $categoriesId = $this->data['categories_id'];
        unset($this->data['categories_id']);
        DB::beginTransaction();
        try {
            $post = $this->repository->update($this->data['id'], $this->data);

            $this->repository->syncCategories($post, $categoriesId ?? []);
            DB::commit();
            return $post;
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return false;
        }

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}