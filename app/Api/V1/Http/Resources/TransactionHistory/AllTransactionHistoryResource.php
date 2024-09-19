<?php

namespace App\Api\V1\Http\Resources\TransactionHistory;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllTransactionHistoryResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($transactionHistory) {

            return [
                'id' => $transactionHistory->id,
                'user_id' => $transactionHistory->user_id,
                'transaction_type' => $transactionHistory->transaction_type,
                'amount' => $transactionHistory->amount,
                'balance_after' => $transactionHistory->balance_after,
            ];

        });
    }


}
