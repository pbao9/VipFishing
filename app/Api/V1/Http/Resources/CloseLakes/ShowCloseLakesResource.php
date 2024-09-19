<?php

namespace App\Api\V1\Http\Resources\CloseLakes;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowCloseLakesResource extends JsonResource
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
            'lakechild_id' => $this->lakechild_id,
            'close_date' => $this->close_date,
            'open_date' => $this->open_date,
            'close_days' => $this->close_days,
            'canceled_bookings' => $this->canceled_bookings,
            'total_refund_amount' => $this->total_refund_amount,
            'compensation_amount' => $this->compensation_amount,
        ];
    }
}
