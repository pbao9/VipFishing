<?php

namespace App\Admin\Http\Resources\Lakechilds;

use App\Models\Lakechilds;
use Illuminate\Http\Resources\Json\JsonResource;

class LakechildsSearchSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $lakechild = Lakechilds::find($this->id);
        return [
            'id' => $this->id,
            'text' => $this->name . ' - ' . $this->lake->name . ' (' . $this->lake->phone . ')',
            'compensation' => $this->compensation,
            'fishingSets' => $this->fishingSets,
            'name' => $this->name,
            'lake' => $this->lake,
        ];
    }
}
