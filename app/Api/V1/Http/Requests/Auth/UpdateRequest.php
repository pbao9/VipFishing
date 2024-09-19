<?php

namespace App\Api\V1\Http\Requests\Auth;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\User\UserGender;
use App\Enums\User\UserVip;
use BenSampo\Enum\Rules\EnumValue;

class UpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'fullname' => ['nullable', 'string'],
            'email' => [
                'sometimes',
                'required',
                'email',
                'unique:users,email,' . $this->user()->id
            ],
            'gender' => ['nullable', new EnumValue(UserGender::class, false)],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable'],
            'rank_id' => ['nullable', 'exists:App\Models\Ranks,id'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
            'discount_user' => ['nullable', 'int'],
            'rf1' => ['nullable'],
            'rf2' => ['nullable'],
            'rf3' => ['nullable'],
        ];
    }
}
