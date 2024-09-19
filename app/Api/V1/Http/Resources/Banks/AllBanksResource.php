<?php

namespace App\Api\V1\Http\Resources\Banks;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllBanksResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($banks) {

            return [
                'id' => $banks->id,
                'code' => $banks->code,
                'shortname' => $banks->shortname,
                'name' => $banks->name,
                'logo' => $banks->logo,
            ];
        });
    }


}
