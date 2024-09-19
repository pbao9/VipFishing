<?php

namespace App\Api\V1\Http\Resources\Notifications;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Notifications\NotificationsRepositoryInterface;

class ShowNotificationsResource extends JsonResource
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
            'title' => $this ->title,
                    'content' => $this ->content,
                    'status' => $this ->status,
                    'user_id' => $this ->user_id,
                    'admin_id' => $this ->admin_id,
                    
        ];
    }
}
