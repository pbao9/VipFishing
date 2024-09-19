<?php

namespace App\Api\V1\Http\Requests\Auth;

use App\Api\V1\Http\Requests\BaseRequest;

class UpdateAvatarRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPut()
    {
        return [
            'avatar' => ['nullable', 'string'],
        ];
    }
}