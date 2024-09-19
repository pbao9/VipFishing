<?php

namespace App\Api\V1\Http\Resources\Fishs;

use App\Api\V1\Http\Resources\VariationFishs\ShowVariationFishsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Fishs\FishsRepositoryInterface;

class ShowFishsResource extends JsonResource
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
            'province_id' => $this->province_id,
            'variations' => ShowVariationFishsResource::collection($this->whenLoaded('variationFishes'))
        ];
    }
}
