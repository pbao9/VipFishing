<?php

namespace App\Api\V1\Http\Resources\Events;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllEventsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($events) {

            return [
                'id' => $events->id,
                'title' => $events->title,
                'code' => $events->code,
                'picture' => asset($events->picture),
                'reward' => $events->reward,
                'reward_value' => $events->reward_value,
                'reward_quantity' => $events->reward_quantity,
                'start_date' => $events->start_date,
                'end_date' => $events->end_date,
                'status' => $events->status,
                'events_condition' => $events->events_condition,
                'ccv_point' => $events->ccv_point,
                'rank_id' => $events->rank_id,
                'user_id' => $events->user_id,
            ];
        });
    }
}
