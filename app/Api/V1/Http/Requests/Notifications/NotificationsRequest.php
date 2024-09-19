<?php

namespace App\Api\V1\Http\Requests\Notifications;

use App\Api\V1\Http\Requests\BaseRequest;

class NotificationsRequest extends BaseRequest
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
            'title' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],
            'user_id' => ['nullable', 'int'],
            'admin_id' => ['nullable', 'int'],
                 
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
			'id' => ['required', 'exists:App\Models\Notifications,id'],
            'title' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],
            'user_id' => ['nullable', 'int'],
            'admin_id' => ['nullable', 'int'],
            
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
			'id' => ['required', 'exists:App\Models\Notifications,id'],       
        ];
    }
	
}