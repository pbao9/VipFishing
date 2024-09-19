<?php

namespace App\Api\V1\Http\Requests\User;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\User\UserGender;
use App\Enums\User\UserVip;
use BenSampo\Enum\Rules\EnumValue;

class UserRequest extends BaseRequest
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
            'gender' => ['nullable', new EnumValue(UserGender::class, false)],
            'password' => ['nullable', 'string'],
            'avatar' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],
            'rank_id' => ['nullable', 'exists:App\Models\Ranks,id'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
            'ref_status' => ['nullable', 'int'],
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
            'fullname' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'unique:App\Models\User,email,' . $this->id],
            'phone' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone,' . $this->id],
            'address' => ['nullable'],
            'gender' => ['nullable', new EnumValue(UserGender::class, false)],
            'password' => ['nullable', 'string'],
            'avatar' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],
            'rank_id' => ['nullable', 'exists:App\Models\Ranks,id'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
            'ref_status' => ['nullable', 'int'],
            'discount_user' => ['nullable', 'int'],
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
            'id' => ['required', 'exists:App\Models\User,id'],
        ];
    }
}