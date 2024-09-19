<?php

namespace App\Api\V1\Http\Requests\Address;

use App\Api\V1\Http\Requests\BaseRequest;

class ProvinceRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [];
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