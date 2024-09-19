<?php

namespace App\Admin\Http\Requests\Auth;

use App\Admin\Http\Requests\BaseRequest;

class ProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Admin,phone,'.auth('admin')->user()->id],
            'address' => ['nullable']
        ];
    }
}