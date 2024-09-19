<?php

namespace App\Api\V1\Http\Resources\Fishs;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllFishsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($fishs) {

            return [
                'id' => $fishs->id,
                'name' => $fishs->name,
                'province_id' => $fishs->province_id,

            ];
        });
    }
}
