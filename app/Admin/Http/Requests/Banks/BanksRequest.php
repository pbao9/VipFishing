<?php

namespace App\Admin\Http\Requests\Banks;

use App\Admin\Http\Requests\BaseRequest;

class BanksRequest extends BaseRequest
{
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

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Banks,id'],
            'code' => ['nullable', 'string'],
                    'name' => ['nullable', 'string'],
                    
        ];
    }
}