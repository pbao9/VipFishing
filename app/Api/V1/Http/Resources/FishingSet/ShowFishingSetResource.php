<?php

namespace App\Api\V1\Http\Resources\FishingSet;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\FishingSet\FishingSetRepositoryInterface;

class ShowFishingSetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'time_checkin' => $this->time_checkin,
            'duration' => $this->duration,
        ];
    }
}
