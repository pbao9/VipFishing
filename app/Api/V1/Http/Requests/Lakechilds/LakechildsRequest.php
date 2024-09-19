<?php

namespace App\Api\V1\Http\Requests\Lakechilds;

use App\Api\V1\Http\Requests\BaseRequest;

class LakechildsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'limit' => ['nullable', 'integer', 'min:1']
        ];
    }
	
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
            'fish_density' => ['nullable', 'int'],
            'fishing_rod_limit' => ['nullable', 'int'],
            'open_time' => ['nullable', 'string'],
            'close_time' => ['nullable', 'string'],
            'open_day' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],
            'compensation' => ['nullable', 'int'],
            'collect_fish_price' => ['nullable', 'int'],
            'collect_fish_type' => ['nullable', 'int'],
            'commission_rate' => ['nullable', 'int'],
            'type' => ['nullable', 'int'],
            'lake_id' => ['nullable', 'int'],
                 
        ];
    }
	
	
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
			'id' => ['required', 'exists:App\Models\Lakechilds,id'],
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'area' => ['nullable', 'int'],
            'fish_volume' => ['nullable', 'int'],
            'fish_density' => ['nullable', 'int'],
            'fishing_rod_limit' => ['nullable', 'int'],
            'open_time' => ['nullable', 'string'],
            'close_time' => ['nullable', 'string'],
            'open_day' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],
            'compensation' => ['nullable', 'int'],
            'collect_fish_price' => ['nullable', 'int'],
            'collect_fish_type' => ['nullable', 'int'],
            'commission_rate' => ['nullable', 'int'],
            'type' => ['nullable', 'int'],
            'lake_id' => ['nullable', 'int'],
            
        ];
    }
	
		/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodDelete()
    {
        return [
			'id' => ['required', 'exists:App\Models\Lakechilds,id'],       
        ];
    }
	
}