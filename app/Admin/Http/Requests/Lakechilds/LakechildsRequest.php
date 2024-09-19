<?php

namespace App\Admin\Http\Requests\Lakechilds;

use App\Admin\Http\Requests\BaseRequest;

class LakechildsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'area' => ['nullable', 'int'],
            'fish_volume' => ['nullable', 'int'],
            'fish_density' => ['nullable', 'numeric'],
            'fishing_rod_limit' => ['nullable', 'int'],
            'open_time' => ['nullable', 'string'],
            'close_time' => ['nullable', 'string'],
            'open_day' => ['nullable', 'array'],
            'status' => ['nullable', 'int'],
            'compensation' => ['nullable', 'int'],
            'collect_fish_price' => ['nullable', 'int'],
            'collect_fish_type' => ['nullable', 'int'],
            'morning_set' => ['nullable', 'int'],
            'afternoon_set' => ['nullable', 'int'],
            'day_set' => ['nullable', 'int'],
            'free_set' => ['nullable', 'int'],
            'slot' => ['nullable', 'int'],
            'type' => ['nullable', 'int'],
            'lake_id' => ['nullable', 'int'],
            'fish_id' => ['nullable', 'int'],
            'fishingsets_id' => ['required', 'array'],
            'fishingsets_id.*' => ['required', 'exists:App\Models\FishingSet,id'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Lakechilds,id'],
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'area' => ['nullable', 'int'],
            'fish_volume' => ['nullable', 'int'],
            'fish_density' => ['nullable', 'numeric'],
            'fishing_rod_limit' => ['nullable', 'int'],
            'open_time' => ['nullable', 'string'],
            'close_time' => ['nullable', 'string'],
            'open_day' => ['nullable', 'array'],
            'status' => ['nullable', 'int'],
            'compensation' => ['nullable', 'int'],
            'collect_fish_price' => ['nullable', 'int'],
            'collect_fish_type' => ['nullable', 'int'],
            'commission_rate' => ['nullable', 'int'],
            'morning_set' => ['nullable', 'int'],
            'afternoon_set' => ['nullable', 'int'],
            'day_set' => ['nullable', 'int'],
            'free_set' => ['nullable', 'int'],
            'slot' => ['nullable', 'int'],
            'type' => ['nullable', 'int'],
            'lake_id' => ['nullable', 'int'],
            'fish_id' => ['nullable', 'int'],
            'fishingsets_id' => ['nullable', 'array'],
            'fishingsets_id.*' => ['nullable', 'exists:App\Models\FishingSet,id'],
        ];
    }
}
