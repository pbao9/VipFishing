<?php

namespace App\Api\V1\Http\Resources\Lakechilds;

use App\Admin\Http\Resources\Lakechilds\ActivityDaySearchSelectResource;
use App\Api\V1\Http\Resources\Fishs\ShowFishsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Lakechilds\LakechildsRepositoryInterface;

class ShowLakechildsResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'area' => $this->area,
            'fish_volume' => $this->fish_volume,
            'fish_density' => $this->fish_density,
            'fishing_rod_limit' => $this->fishing_rod_limit,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'open_day' => is_string($this->open_day) ? json_decode($this->open_day, true) : $this->open_day,
            'operating' => ActivityDayResource::collection($this->whenLoaded('activityDates')),
            'status' => $this->status,
            'compensation' => $this->compensation,
            'collect_fish_price' => $this->collect_fish_price,
            'collect_fish_type' => $this->collect_fish_type,
            'type' => $this->type,
            'fish' => new ShowFishsResource($this->whenLoaded('fish')),
        ];
    }
}
