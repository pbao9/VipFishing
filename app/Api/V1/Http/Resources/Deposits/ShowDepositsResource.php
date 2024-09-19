<?php

namespace App\Api\V1\Http\Resources\Deposits;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowDepositsResource extends JsonResource
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
            'code' => $this->code,
            'user_id' => $this->user_id,
            'admin_id' => $this->admin_id,
            'amount' => $this->amount,
            'note' => $this->note,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
