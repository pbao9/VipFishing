<?php

namespace App\Api\V1\Http\Requests\Lakes;

use App\Api\V1\Http\Requests\BaseRequest;

class LakesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [
            'name' => 'sometimes|string',
            'province_code' => 'sometimes|string',
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
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'map' => ['nullable', 'string'],
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'legal_representation' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'car_parking' => ['nullable', 'int'],
            'dinner' => ['nullable', 'int'],
            'lunch' => ['nullable', 'int'],
            'toilet' => ['nullable', 'int'],
            'avatar' => ['nullable', 'string'],
            'slot_lakechild' => ['nullable', 'int'],
            'status' => ['nullable', 'int'],
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
            'id' => ['required', 'exists:App\Models\Lakes,id'],
            'name' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'map' => ['nullable', 'string'],
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'legal_representation' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'car_parking' => ['nullable', 'int'],
            'dinner' => ['nullable', 'int'],
            'lunch' => ['nullable', 'int'],
            'toilet' => ['nullable', 'int'],
            'avatar' => ['nullable', 'string'],
            'slot_lakechild' => ['nullable', 'int'],
            'status' => ['nullable', 'int'],
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
			'id' => ['required', 'exists:App\Models\Lakes,id'],
        ];
    }

}
