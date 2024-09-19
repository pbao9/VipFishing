<?php

namespace App\Admin\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingSearchSelectResource extends JsonResource
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
            'text' => $this->id . ' - ' . $this->lakechild->name . ' - ' . number_format($this->total_price, 0, ',', '.') . 'VNĐ'
        ];
    }
}