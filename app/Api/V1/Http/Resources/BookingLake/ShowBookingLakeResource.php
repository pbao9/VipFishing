<?php

namespace App\Api\V1\Http\Resources\BookingLake;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowBookingLakeResource extends JsonResource
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
            'booking_id' => $this->booking_id,
            'variationFishs_id' => $this->variationFishs_id,
            'total_price' => $this->total_price,
        ];
    }
}
