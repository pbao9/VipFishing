<?php

namespace App\Admin\Http\Resources\Bank;

use Illuminate\Http\Resources\Json\JsonResource;

class BankSearchSelectResource extends JsonResource
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
            'text' => $this->code.' - '.$this->name
        ];
    }
}