<?php

namespace App\Api\V1\Http\Requests\Ratings;

use App\Api\V1\Http\Requests\BaseRequest;

class RatingsRequest extends BaseRequest
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
            'rate' => ['nullable', 'int'],
            'note' => ['nullable', 'string'],
            'picture' => ['nullable'],
            'lake_id' => ['nullable', 'int'],
            'lakechild_id' => ['nullable', 'int'],
            'status' => ['nullable', 'int'],
            'feedback' => ['nullable', 'string'],
            'booking_id' => ['nullable', 'int'],
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
			'id' => ['required', 'exists:App\Models\Ratings,id'],
            'rate' => ['nullable', 'int'],
            'note' => ['nullable', 'string'],
            'picture' => ['nullable'],
            'lake_id' => ['nullable', 'int'],
            'lakechild_id' => ['nullable', 'int'],
            'status' => ['nullable', 'int'],
            'feedback' => ['nullable', 'int'],
            'booking_id' => ['nullable', 'int'],
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
			'id' => ['required', 'exists:App\Models\Ratings,id'],
        ];
    }
}
