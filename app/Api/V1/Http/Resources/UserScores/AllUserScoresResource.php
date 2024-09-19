<?php

namespace App\Api\V1\Http\Resources\UserScores;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllUserScoresResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($userScores) {

            return [
                'id' => $userScores->id,
                'user_id' => $userScores->user_id,
                'total_ccv' => $userScores->total_ccv,
                'total_round' => $userScores->total_round,
                'total_hcv' => $userScores->total_hcv,
                'total_awards' => $userScores->total_awards,
                'total_lake' => $userScores->total_lake,
                'total_province' => $userScores->total_province,
                'total_rating' => $userScores->total_rating,

            ];

        });
    }


}
