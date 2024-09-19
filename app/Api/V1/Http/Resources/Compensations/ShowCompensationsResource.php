<?php

namespace App\Api\V1\Http\Resources\Compensations;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowCompensationsResource extends JsonResource
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
            'amount' => $this->amount,
            'booking_id' => $this->booking_id,
            'user_id' => $this->user_id,
            'type' => $this->type,
        ];
    }
}
