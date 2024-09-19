<?php

namespace App\Api\V1\Http\Resources\Deposits;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllDepositsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($deposits) {

            return [
                'id' => $deposits->id,
                'code' => $deposits->code,
                'user_id' => $deposits->user_id,
                'admin_id' => $deposits->admin_id,
                'amount' => $deposits->amount,
                'note' => $deposits->note,
                'status' => $deposits->status,
                'type' => $deposits->type,

            ];

        });
    }


}
