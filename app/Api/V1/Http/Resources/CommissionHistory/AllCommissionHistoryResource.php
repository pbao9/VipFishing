<?php

namespace App\Api\V1\Http\Resources\CommissionHistory;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCommissionHistoryResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($commissionHistory) {

            return [
                'id' => $commissionHistory->id,
                'amount' => $commissionHistory->amount,
                'type' => $commissionHistory->type,
                'user_id' => $commissionHistory->user_id,
                'booking_id' => $commissionHistory->booking_id,
            ];

        });
    }


}
