<?php

namespace App\Api\V1\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class AllUserRefer extends JsonResource
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
            'user_id' => $this->id,
            'name' => $this->fullname,
            'phone' => $this->phone,
            'join_date' => $this->created_at->format('Y-m-d'),
        ];
    }
}
