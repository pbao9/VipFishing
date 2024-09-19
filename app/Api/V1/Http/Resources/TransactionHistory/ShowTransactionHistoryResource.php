<?php

namespace App\Api\V1\Http\Resources\TransactionHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowTransactionHistoryResource extends JsonResource
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
            'transaction_type' => $this->transaction_type,
            'amount' => $this->amount,
            'balance_after' => $this->balance_after,
        ];
    }
}
