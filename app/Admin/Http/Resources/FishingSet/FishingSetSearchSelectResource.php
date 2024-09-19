<?php

namespace App\Admin\Http\Resources\FishingSet;

use Illuminate\Http\Resources\Json\JsonResource;

class FishingSetSearchSelectResource extends JsonResource
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
            'text' => $this->title
            
        ];
    }
}