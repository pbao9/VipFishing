<?php

namespace App\Api\V1\Http\Requests\Banks;

use App\Api\V1\Http\Requests\BaseRequest;

class BanksRequest extends BaseRequest
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
            'code' => ['nullable', 'string'],
            'name' => ['nullable', 'string'],

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
            'id' => ['required', 'exists:App\Models\Banks,id'],
            'code' => ['nullable', 'string'],
            'name' => ['nullable', 'string'],

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
            'id' => ['required', 'exists:App\Models\Banks,id'],
        ];
    }

}