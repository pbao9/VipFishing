<?php

namespace App\Api\V1\Http\Resources\LakeFishs;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\LakeFishs\LakeFishsRepositoryInterface;

class ShowLakeFishsResource extends JsonResource
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
            'lakechild_id' => $this ->lakechild_id,
            'fish_id' => $this ->fish_id,
                    
        ];
    }
}
