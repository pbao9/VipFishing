<?php

namespace App\Admin\Http\Requests\Fishs;

use App\Admin\Http\Requests\BaseRequest;

class FishsRequest extends BaseRequest
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
            'province_id' => ['nullable', 'string'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Fishs,id'],
            'name' => ['nullable', 'string'],
            'province_id' => ['nullable', 'string'],
        ];
    }
}
