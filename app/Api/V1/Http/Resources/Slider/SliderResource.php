<?php

namespace App\Api\V1\Http\Resources\Slider;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'name' => $this->name,
            'desc' => $this->desc,
            'items' => $this->items->map(function($item){
                return [
                    'title' => $item->title,
                    'link' => $item->link,
                    'image' => asset($item->image),
                    'mobile_image' => asset($item->mobile_image)
                ];
            })
        ];
    }
}
