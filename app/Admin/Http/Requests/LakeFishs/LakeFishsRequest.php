<?php

namespace App\Admin\Http\Requests\LakeFishs;

use App\Admin\Http\Requests\BaseRequest;

class LakeFishsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'lakechild_id' => ['nullable', 'int'],
            'fish_id' => ['nullable', 'int'],

        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\LakeFishs,id'],
            'lakechild_id' => ['nullable', 'int'],
            'fish_id' => ['nullable', 'int'],

        ];
    }
}
