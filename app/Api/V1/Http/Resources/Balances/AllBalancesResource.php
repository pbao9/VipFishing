<?php

namespace App\Api\V1\Http\Resources\Balances;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllBalancesResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($balances) {

            return [
                'id' => $balances->id,
                'user_id' => $balances->user_id,
                'total_balance' => $balances->total_balance,
            ];

        });
    }


}
