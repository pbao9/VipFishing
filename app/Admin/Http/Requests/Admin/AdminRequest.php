<?php

namespace App\Admin\Http\Requests\Admin;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Admin\AdminRoles;


class AdminRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'email' => ['required', 'email', 'unique:App\Models\Admin,email'],
            'fullname' => ['required', 'string'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Admin,phone'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Admin,id'],
            'email' => ['required', 'email', 'unique:App\Models\Admin,email,'.$this->id],
            'fullname' => ['required', 'string'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Admin,phone,'.$this->id],
            'password' => ['nullable', 'string', 'confirmed'],
        ];
    }
}