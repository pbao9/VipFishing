<?php

namespace App\Api\V1\Http\Resources\Notifications;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllNotificationsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($notifications){
            
            return [
                'id' => $notifications->id,
                'title' => $notifications->title,
                    'content' => $notifications->content,
                    'status' => $notifications->status,
                    'user_id' => $notifications->user_id,
                    'admin_id' => $notifications->admin_id,
                    
            ];
            
        });
    }

    
}
