<?php

namespace App\Api\V1\Http\Resources\Ranks;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllRanksResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($ranks){
            
            return [
                'id' => $ranks->id,
                'title' => $ranks->title,
                    'hcv_point' => $ranks->hcv_point,
                    'ccv_point' => $ranks->ccv_point,
                    'round' => $ranks->round,
                    'awards' => $ranks->awards,
                    'lake' => $ranks->lake,
                    'province' => $ranks->province,
                    'stauts_comission' => $ranks->stauts_comission,
                    'rating' => $ranks->rating,
                    
            ];
            
        });
    }

    
}
