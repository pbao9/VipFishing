<?php

namespace App\Api\V1\Http\Resources\Compensations;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCompensationsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($compensations) {

            return [
                'id' => $compensations->id,
                'amount' => $compensations->amount,
                'booking_id' => $compensations->booking_id,
                'user_id' => $compensations->user_id,
                'type' => $compensations->type,
            ];

        });
    }


}
