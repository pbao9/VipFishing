<?php

namespace App\Api\V1\Http\Resources\Lakes;

use App\Api\V1\Http\Resources\Lakechilds\ShowLakechildsResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllLakesResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($lakes) {

            return [
                'id' => $lakes->id,
                'name' => $lakes->name,
                'phone' => $lakes->phone,
                'province_id' => $lakes->province_id,
                'map' => $lakes->map,
                'description' => $lakes->description,
                'car_parking' => $lakes->car_parking,
                'dinner' => $lakes->dinner,
                'lunch' => $lakes->lunch,
                'toilet' => $lakes->toilet,
                'avatar' => asset($lakes->avatar),
                'status' => $lakes->status,
                'latitude' => $lakes->latitude,
                'longitude' => $lakes->longitude,
                'avg_rating' => $lakes->avgRating(),
                'total_rating' => $lakes->countRating(),
                'total_lakechild' => $lakes->countLakechilds(),
                'lake_child' => ShowLakechildsResource::collection($lakes->lakechilds)
            ];
        })->toArray();
    }
}
