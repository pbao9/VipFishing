<?php

namespace App\Api\V1\Http\Resources\BookingLake;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllBookingLakeResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($bookingLake) {

            return [
                'id' => $bookingLake->id,
                'booking_id' => $bookingLake->booking_id,
                'variationFishs_id' => $bookingLake->variationFishs_id,
                'total_price' => $bookingLake->total_price,
            ];

        });
    }


}
