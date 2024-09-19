<?php

namespace App\Api\V1\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllUserResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($user) {

            return [
                'id' => $user->id,
                'code' => $user->code,
                'username' => $user->username,
                'fullname' => $user->fullname,
                'phone' => $user->phone,
                'email' => $user->email,
                'address' => $user->address,
                'gender' => $user->gender,
                'roles' => $user->roles,
                'vip' => $user->vip,
                'avatar' => $user->avatar,
                'status' => $user->status,
                'rank_id' => $user->rank_id,
                'bank_id' => $user->bank_id,
                'bank_number' => $user->bank_number,
                'ref_status' => $user->ref_status,
                'discount_user' => $user->discount_user,
            ];

        });
    }


}
