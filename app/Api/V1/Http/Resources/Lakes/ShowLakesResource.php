<?php

namespace App\Api\V1\Http\Resources\Lakes;

use App\Api\V1\Http\Resources\Lakechilds\AllLakechildsResource;
use App\Api\V1\Http\Resources\Lakechilds\ShowLakechildsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Lakes\LakesRepositoryInterface;

class ShowLakesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'province_id' => $this->province_id,
            'map' => $this->map,
            'description' => $this->description,
            'car_parking' => $this->car_parking,
            'dinner' => $this->dinner,
            'lunch' => $this->lunch,
            'toilet' => $this->toilet,
            'avatar' => asset($this->avatar),
            'status' => $this->status,
            'avg_rating' => $this->avgRating(),
            'total_rating' => $this->countRating(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'total_lakechild' => $this->countLakechilds(),
            'lake_child' => ShowLakechildsResource::collection($this->whenLoaded('lakechilds')),
        ];
    }
}
