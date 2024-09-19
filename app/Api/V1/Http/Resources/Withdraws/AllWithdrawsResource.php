<?php

namespace App\Api\V1\Http\Resources\Withdraws;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllWithdrawsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($withdraws) {

            return [
                'id' => $withdraws->id,
                'code' => $withdraws->code,
                'user_id' => $withdraws->user_id,
                'admin_id' => $withdraws->admin_id,
                'amount' => $withdraws->amount,
                'note' => $withdraws->note,
                'status' => $withdraws->status,
                'other_bank' => $withdraws->other_bank,
                'bank_id' => $withdraws->bank_id,
                'bank_number' => $withdraws->bank_number,
                'type' => $withdraws->type,
            ];

        });
    }


}
