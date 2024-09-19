<?php

namespace App\Api\V1\Http\Resources\FishingSet;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllFishingSetResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($fishingSet) {

            return [
                'id' => $fishingSet->id,
                'title' => $fishingSet->title,
                'time_start' => $fishingSet->time_start,
                'time_end' => $fishingSet->time_end,
                'time_checkin' => $fishingSet->time_checkin,
                'duration' => $fishingSet->duration,
            ];

        });
    }


}
