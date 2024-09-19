<?php

namespace App\Api\V1\Http\Requests\FishingSet;

use App\Api\V1\Http\Requests\BaseRequest;

class FishingSetRequest extends BaseRequest
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
            'time_start' => ['nullable', 'string'],
            'time_end' => ['nullable', 'string'],
            'time_checkin' => ['nullable', 'string'],
            'duration' => ['nullable', 'int'],
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
			'id' => ['required', 'exists:App\Models\FishingSet,id'],
            'title' => ['nullable', 'string'],
            'time_start' => ['nullable', 'string'],
            'time_end' => ['nullable', 'string'],
            'time_checkin' => ['nullable', 'string'],
            'duration' => ['nullable', 'int'],
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
			'id' => ['required', 'exists:App\Models\FishingSet,id'],
        ];
    }

}
