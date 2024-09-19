<?php

namespace App\Api\V1\Http\Resources\UserEvents;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllUserEventsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($userEvents) {

            return [
                'id' => $userEvents->id,
                'event_id' => $userEvents->event_id,
                'user_id' => $userEvents->user_id,
                'has_reward' => $userEvents->has_reward,
            ];

        });
    }


}
