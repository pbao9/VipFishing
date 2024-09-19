<?php

namespace App\Api\V1\Http\Resources\Bookings;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowBookingsResource extends JsonResource
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
            'fishing_date' => $this->fishing_date,
            'position' => $this->position,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'booking_code' => $this->booking_code,
            'lakeChild_id' => $this->lakeChild_id,
            'fishingset_id' => $this->fishingset_id,
        ];
    }
}
