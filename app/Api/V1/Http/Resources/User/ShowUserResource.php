<?php

namespace App\Api\V1\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'username' => $this->username,
            'fullname' => $this->fullname,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'gender' => $this->gender,
            'roles' => $this->roles,
            'vip' => $this->vip,
            'avatar' => $this->avatar,
            'status' => $this->status,
            'rank_id' => $this->rank_id,
            'bank_id' => $this->bank_id,
            'bank_number' => $this->bank_number,
            'ref_status' => $this->ref_status,
            'discount_user' => $this->discount_user,
        ];
    }
}
