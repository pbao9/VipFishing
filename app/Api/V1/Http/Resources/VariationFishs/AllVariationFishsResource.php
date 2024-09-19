<?php

namespace App\Api\V1\Http\Resources\VariationFishs;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllVariationFishsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($variationFishs){
            
            return [
                'id' => $variationFishs->id,
                'fish_id' => $variationFishs->fish_id,
                    'fish_density' => $variationFishs->fish_density,
                    'fish_price' => $variationFishs->fish_price,
                    
            ];
            
        });
    }

    
}
