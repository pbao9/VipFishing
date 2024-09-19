<?php

namespace App\Api\V1\Http\Resources\Balances;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowBalancesResource extends JsonResource
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
            'user_id' => $this->user_id,
            'total_balance' => $this->total_balance,
        ];
    }
}
