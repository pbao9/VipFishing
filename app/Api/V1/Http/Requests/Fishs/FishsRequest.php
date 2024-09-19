<?php

namespace App\Api\V1\Http\Requests\Fishs;

use App\Api\V1\Http\Requests\BaseRequest;

class FishsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [
            'search' => ['nullable', 'string'],
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
            'province_code' => ['nullable', 'integer'],

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
			'id' => ['required', 'exists:App\Models\Fishs,id'],
            'name' => ['nullable', 'string'],
            'province_code' => ['nullable', 'string'],
            
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
			'id' => ['required', 'exists:App\Models\Fishs,id'],       
        ];
    }
	
}