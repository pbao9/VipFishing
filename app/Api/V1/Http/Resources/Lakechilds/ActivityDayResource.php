<?php

namespace App\Api\V1\Http\Resources\Lakechilds;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityDayResource extends JsonResource
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
            'date' => $this->activity_date,
        ];
    }
}
