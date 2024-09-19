<?php

namespace App\Admin\Http\Requests\Lakes;

use App\Admin\Http\Requests\BaseRequest;

class LakesRequest extends BaseRequest
{
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
            'province_id' => ['nullable'],
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

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Lakes,id'],
            'name' => ['nullable', 'string'],
            'province_id' => ['nullable', 'string'],
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
}
