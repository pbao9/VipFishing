<?php

namespace App\Api\V1\Http\Requests\UserScores;

use App\Api\V1\Http\Requests\BaseRequest;

class UserScoresRequest extends BaseRequest
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
            'user_id' => ['nullable', 'int'],
            'total_ccv' => ['nullable', 'int'],
            'total_round' => ['nullable', 'int'],
            'total_hcv' => ['nullable', 'int'],
            'total_awards' => ['nullable', 'int'],
            'total_lake' => ['nullable', 'int'],
            'total_province' => ['nullable', 'int'],
            'total_rating' => ['nullable', 'int'],
                 
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
			'id' => ['required', 'exists:App\Models\UserScores,id'],
            'user_id' => ['nullable', 'int'],
            'total_ccv' => ['nullable', 'int'],
            'total_round' => ['nullable', 'int'],
            'total_hcv' => ['nullable', 'int'],
            'total_awards' => ['nullable', 'int'],
            'total_lake' => ['nullable', 'int'],
            'total_province' => ['nullable', 'int'],
            'total_rating' => ['nullable', 'int'],
            
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
			'id' => ['required', 'exists:App\Models\UserScores,id'],       
        ];
    }
	
}