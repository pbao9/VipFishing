<?php

namespace App\Api\V1\Http\Requests\Auth;

use App\Api\V1\Http\Requests\BaseRequest;

class ResetPasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

     protected function methodPost()
     {
         return [
             'email' =>['required', 'exists:App\Models\User,email']
         ];
     }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPut()
    {
        return [
            'password' => ['required', 'string', 'max:255', 'confirmed'],
        ];
    }
}