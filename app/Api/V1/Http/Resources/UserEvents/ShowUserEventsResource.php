<?php

namespace App\Api\V1\Http\Resources\UserEvents;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\UserEvents\UserEventsRepositoryInterface;

class ShowUserEventsResource extends JsonResource
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
            'event_id' => $this->event_id,
            'user_id' => $this->user_id,
            'has_reward' => $this->has_reward,
        ];
    }
}
