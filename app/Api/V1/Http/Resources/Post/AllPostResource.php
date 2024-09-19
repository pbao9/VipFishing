<?php

namespace App\Api\V1\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllPostResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($post){
            
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'image' => asset($post->image),
                'is_featured' => $post->is_featured,
                'excerpt' => $post->excerpt,
                'posted_at' => $post->posted_at,
            ];
            
        });
    }

    
}
