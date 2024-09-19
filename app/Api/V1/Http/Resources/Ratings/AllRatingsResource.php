<?php

namespace App\Api\V1\Http\Resources\Ratings;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllRatingsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($ratings) {
            $pictures = is_iterable($ratings->picture) ? (array) $ratings->picture : [$ratings->picture];

            $pictures = array_map(function ($picture) {
                return $picture ? asset($picture) : null;
            }, $pictures);

            return [
                'id' => $ratings->id,
                'rate' => $ratings->rate,
                'note' => $ratings->note,
                'picture' => $pictures,
                'lake_id' => $ratings->lake_id,
                'lakechild_id' => $ratings->lakechild_id,
                'booking_id' => $ratings->booking_id,
            ];
        });
    }
}
