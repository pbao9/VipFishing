<?php

namespace App\Api\V1\Http\Resources\Bookings;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllBookingsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($bookings) {

            return [
                'id' => $bookings->id,
                'fishing_date' => $bookings->fishing_date,
                'position' => $bookings->position,
                'total_price' => $bookings->total_price,
                'user_id' => $bookings->user_id,
                'status' => $bookings->status,
                'booking_code' => $bookings->booking_code,
                'lakeChild_id' => $bookings->lakeChild_id,
                'fishingset_id' => $bookings->fishingset_id,
            ];
        });
    }
}
