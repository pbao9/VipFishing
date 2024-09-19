<?php

namespace App\Admin\Http\Requests\User;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\User\{UserVip, UserGender};

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            // 'username' => [
            //     'required', 
            //     'string', 'min:6', 'max:50',
            //     'unique:App\Models\User,username', 
            //     'regex:/^[A-Za-z0-9_-]+$/',
            //     function ($attribute, $value, $fail) {
            //         if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
            //             $fail('The '.$attribute.' cannot be a common keyword.');
            //         }
            //     },
            // ],
            'fullname' => ['required', 'string'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'address' => ['nullable'],
            'gender' => ['required', new EnumValue(UserGender::class, false)],
            'password' => ['required', 'string', 'confirmed'],
            'avatar' => ['nullable', 'string'],
            'status' => ['required', 'int'],
            'rank_id' => ['nullable', 'exists:App\Models\Ranks,id'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
            'ref_status' => ['required', 'int'],
            'discount_user' => ['nullable', 'int'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
            // 'username' => [
            //     'required', 
            //     'string', 'min:6', 'max:50',
            //     'unique:App\Models\User,username,'.$this->id, 
            //     'regex:/^[A-Za-z0-9_-]+$/',
            //     function ($attribute, $value, $fail) {
            //         if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
            //             $fail('The '.$attribute.' cannot be a common keyword.');
            //         }
            //     },
            // ],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email,' . $this->id],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone,' . $this->id],
            'address' => ['nullable'],
            'gender' => ['required', new EnumValue(UserGender::class, false)],
            'password' => ['nullable', 'string', 'confirmed'],
            'avatar' => ['nullable', 'string'],
            'status' => ['required', 'int'],
            'rank_id' => ['nullable', 'exists:App\Models\Ranks,id'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
            'ref_status' => ['required', 'int'],
            'discount_user' => ['nullable', 'int'],
        ];
    }
}