<?php

namespace App\Admin\Http\Resources\Lakechilds;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityDaySearchSelectResource extends JsonResource
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
            'text' => $this->activity_date . ' - ' . $this->lakechild->name,
        ];
    }
}
