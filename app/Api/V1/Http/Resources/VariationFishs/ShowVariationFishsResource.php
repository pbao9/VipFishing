<?php

namespace App\Api\V1\Http\Resources\VariationFishs;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\VariationFishs\VariationFishsRepositoryInterface;

class ShowVariationFishsResource extends JsonResource
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
            'fish_density' => $this->fish_density,
            'fish_price' => $this->fish_price,
        ];
    }
}
