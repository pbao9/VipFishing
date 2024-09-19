<?php

namespace App\Api\V1\Http\Requests\Auth;

use App\Api\V1\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'nullable'
        ];
    }
}
