<?php

namespace App\Api\V1\Http\Resources\LakeEvents;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\LakeEvents\LakeEventsRepositoryInterface;

class ShowLakeEventsResource extends JsonResource
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
            'event_id' => $this ->event_id,
                    'lakeChild_id' => $this ->lakeChild_id,
                    
        ];
    }
}
