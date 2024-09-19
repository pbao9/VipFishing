<?php

namespace App\Api\V1\Http\Resources\LakeEvents;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllLakeEventsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($lakeEvents){
            
            return [
                'id' => $lakeEvents->id,
                'event_id' => $lakeEvents->event_id,
                    'lakeChild_id' => $lakeEvents->lakeChild_id,
                    
            ];
            
        });
    }

    
}
