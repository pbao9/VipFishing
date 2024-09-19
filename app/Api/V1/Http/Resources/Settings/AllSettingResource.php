<?php

namespace App\Api\V1\Http\Resources\Settings;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllSettingResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($setting) {
            $isImageUrl = preg_match('/^\/public\/.*/', $setting->plain_value);

            return [
                'id' => $setting->id,
                'setting_key' => $setting->setting_key,
                'setting_name' => $setting->setting_name,
                'plain_value' => $isImageUrl ? asset($setting->plain_value) : $setting->plain_value,
            ];
        });
    }
}
