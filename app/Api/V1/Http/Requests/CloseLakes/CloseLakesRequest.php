<?php

namespace App\Api\V1\Http\Requests\CloseLakes;

use App\Api\V1\Http\Requests\BaseRequest;

class CloseLakesRequest extends BaseRequest
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
            'lakechild_id' => ['required', 'exists:App\Models\Lakechilds,id'],
            'close_date' => ['required', 'string'],
            'open_date' => ['required', 'string'],
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
            'id' => ['required', 'exists:App\Models\CloseLakes,id'],
            'lakechild_id' => ['nullable', 'exists:App\Models\Lakechilds,id'],
            'close_date' => ['required', 'string'],
            'open_date' => ['required', 'string'],
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
            'id' => ['required', 'exists:App\Models\CloseLakes,id'],
        ];
    }

}
