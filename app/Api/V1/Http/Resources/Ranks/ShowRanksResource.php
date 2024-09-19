<?php

namespace App\Api\V1\Http\Resources\Ranks;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Ranks\RanksRepositoryInterface;

class ShowRanksResource extends JsonResource
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
                    'hcv_point' => $this ->hcv_point,
                    'ccv_point' => $this ->ccv_point,
                    'round' => $this ->round,
                    'lake' => $this ->lake,
                    'province' => $this ->province,
                    'stauts_comission' => $this ->stauts_comission,
                    'rating' => $this ->rating,
                    
        ];
    }
}
