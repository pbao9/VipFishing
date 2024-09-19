<?php

namespace App\Api\V1\Http\Resources\LakeFishs;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllLakeFishsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($lakeFishs){
            
            return [
                'id' => $lakeFishs->id,
                'lakechild_id' => $lakeFishs->lakechild_id,
                'fish_id' => $lakeFishs->fish_id,
                    
            ];
            
        });
    }

    
}
