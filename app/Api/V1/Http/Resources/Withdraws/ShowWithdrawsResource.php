<?php

namespace App\Api\V1\Http\Resources\Withdraws;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowWithdrawsResource extends JsonResource
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
            'other_bank' => $this->other_bank,
            'bank_id' => $this->bank_id,
            'bank_number' => $this->bank_number,
            'type' => $this->type,
        ];
    }
}
