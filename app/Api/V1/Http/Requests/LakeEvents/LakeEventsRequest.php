<?php

namespace App\Api\V1\Http\Requests\LakeEvents;

use App\Api\V1\Http\Requests\BaseRequest;

class LakeEventsRequest extends BaseRequest
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
            'lakeChild_id' => ['nullable', 'int'],
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
			'id' => ['required', 'exists:App\Models\LakeEvents,id'],
            'event_id' => ['nullable', 'int'],
            'lakeChild_id' => ['nullable', 'int'],

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
			'id' => ['required', 'exists:App\Models\LakeEvents,id'],
        ];
    }

}
