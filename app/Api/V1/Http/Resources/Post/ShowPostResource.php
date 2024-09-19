<?php

namespace App\Api\V1\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Product\ProductRepositoryInterface;

class ShowPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => asset($this->image),
            'is_featured' => $this->is_featured,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'posted_at' => $this->posted_at,
        ];
    }
}
