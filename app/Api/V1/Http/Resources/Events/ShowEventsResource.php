<?php

namespace App\Api\V1\Http\Resources\Events;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Events\EventsRepositoryInterface;

class ShowEventsResource extends JsonResource
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
            'title' => $this->title,
            'code' => $this->code,
            'picture' => $this->picture,
            'reward' => $this->reward,
            'reward_value' => $this->reward_value,
            'reward_quantity' => $this->reward_quantity,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'events_condition' => $this->events_condition,
            'ccv_point' => $this->ccv_point,
            'rank_id' => $this->rank_id,
            'user_id' => $this->user_id,

        ];
    }
}
