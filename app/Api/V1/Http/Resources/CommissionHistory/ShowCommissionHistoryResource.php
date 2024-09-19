<?php

namespace App\Api\V1\Http\Resources\CommissionHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowCommissionHistoryResource extends JsonResource
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
            'type' => $this->type,
            'user_id' => $this->user_id,
            'booking_id' => $this->booking_id,
        ];
    }
}
