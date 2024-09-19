<?php

namespace App\Api\V1\Http\Resources\UserScores;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\UserScores\UserScoresRepositoryInterface;

class ShowUserScoresResource extends JsonResource
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
            'total_ccv' => $this->total_ccv,
            'total_round' => $this->total_round,
            'total_hcv' => $this->total_hcv,
            'total_awards' => $this->total_awards,
            'total_lake' => $this->total_lake,
            'total_province' => $this->total_province,
            'total_rating' => $this->total_rating,
        ];
    }
}
