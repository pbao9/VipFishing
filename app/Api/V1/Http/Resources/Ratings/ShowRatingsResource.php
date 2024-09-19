<?php

namespace App\Api\V1\Http\Resources\Ratings;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Ratings\RatingsRepositoryInterface;

class ShowRatingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $pictures = is_iterable($this->picture) ? (array) $this->picture : [$this->picture];

        $pictures = array_map(function ($picture) {
            return $picture ? asset($picture) : null;
        }, $pictures);

        return [
            'id' => $this->id,
            'rate' => $this->rate,
            'note' => $this->note,
            'pictures' => $pictures,
            'booking_id' => $this->booking_id,
        ];
    }
}
