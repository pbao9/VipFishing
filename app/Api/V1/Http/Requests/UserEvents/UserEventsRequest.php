<?php

namespace App\Api\V1\Http\Requests\UserEvents;

use App\Api\V1\Http\Requests\BaseRequest;

class UserEventsRequest extends BaseRequest
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
            'event_id' => ['nullable', 'int'],
            'user_id' => ['nullable', 'int'],
            'has_reward' => ['nullable', 'int'],
                 
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
			'id' => ['required', 'exists:App\Models\UserEvents,id'],
            'event_id' => ['nullable', 'int'],
            'user_id' => ['nullable', 'int'],
            'has_reward' => ['nullable', 'int'],
            
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
			'id' => ['required', 'exists:App\Models\UserEvents,id'],       
        ];
    }
	
}