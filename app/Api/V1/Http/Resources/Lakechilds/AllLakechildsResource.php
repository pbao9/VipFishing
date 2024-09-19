<?php

namespace App\Api\V1\Http\Resources\Lakechilds;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllLakechildsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($lakechilds) {

            return [
                'id' => $lakechilds->id,
                'name' => $lakechilds->name,
                'description' => $lakechilds->description,
                'area' => $lakechilds->area,
                'fish_volume' => $lakechilds->fish_volume,
                'fish_density' => $lakechilds->fish_density,
                'fishing_rod_limit' => $lakechilds->fishing_rod_limit,
                'open_time' => $lakechilds->open_time,
                'close_time' => $lakechilds->close_time,
                'open_day' => $lakechilds->open_day,
                'status' => $lakechilds->status,
                'compensation' => $lakechilds->compensation,
                'collect_fish_price' => $lakechilds->collect_fish_price,
                'collect_fish_type' => $lakechilds->collect_fish_type,
                'commission_rate' => $lakechilds->commission_rate,
                'type' => $lakechilds->type,
                'lake_id' => $lakechilds->lake_id,
                'fish_id' => $lakechilds->fish_id
            ];
        });
    }
}
