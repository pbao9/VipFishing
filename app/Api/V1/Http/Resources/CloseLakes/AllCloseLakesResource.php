<?php

namespace App\Api\V1\Http\Resources\CloseLakes;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCloseLakesResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($closeLakes) {

            return [
                'id' => $closeLakes->id,
                'lakechild_id' => $closeLakes->lakechild_id,
                'close_date' => $closeLakes->close_date,
                'open_date' => $closeLakes->open_date,
                'close_days' => $closeLakes->close_days,
                'canceled_bookings' => $closeLakes->canceled_bookings,
                'total_refund_amount' => $closeLakes->total_refund_amount,
                'compensation_amount' => $closeLakes->compensation_amount,
            ];

        });
    }


}
