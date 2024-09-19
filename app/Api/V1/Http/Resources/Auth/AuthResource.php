<?php

namespace App\Api\V1\Http\Resources\Auth;

use App\Api\V1\Http\Resources\User\AllUserRefer;
use App\Api\V1\Http\Resources\UserScores\ShowUserScoresResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'fullname' => $this->fullname,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'avatar' => asset($this->avatar),
            'status' => $this->status,
            'rank_id' => $this->rank_id,
            'bank_id' => $this->bank_id,
            'bank_number' => $this->bank_number,
            'referral_code' => $this->referral_code,
            'ref_status' => $this->ref_status,
            'discount_user' => $this->discount_user,
            'total_balance' => $this->balance ? $this->balance->total_balance : 0,
            'score' => ShowUserScoresResource::collection($this->whenLoaded('userscores')),
            'user_referr' => AllUserRefer::collection($this->whenLoaded('refer')),
        ];
    }
}
