<?php

namespace App\Api\V1\Http\Requests\VariationFishs;

use App\Api\V1\Http\Requests\BaseRequest;

class VariationFishsRequest extends BaseRequest
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
            'fish_id' => ['nullable', 'int'],
            'fish_density' => ['nullable', 'int'],
            'fish_price' => ['nullable', 'int'],
                 
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
			'id' => ['required', 'exists:App\Models\VariationFishs,id'],
            'fish_id' => ['nullable', 'int'],
            'fish_density' => ['nullable', 'int'],
            'fish_price' => ['nullable', 'int'],
            
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
			'id' => ['required', 'exists:App\Models\VariationFishs,id'],       
        ];
    }
	
}