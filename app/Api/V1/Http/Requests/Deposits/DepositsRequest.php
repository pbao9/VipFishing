<?php

namespace App\Api\V1\Http\Requests\Deposits;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Deposits\DepositsStatus;
use BenSampo\Enum\Rules\EnumValue;

class DepositsRequest extends BaseRequest
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
            // 'user_id' => ['nullable', 'exists:App\Models\User,id'],
            'amount' => ['required', 'int'],
            'note' => ['nullable', 'string'],
            'license' => ['nullable'],
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
            'id' => ['required', 'exists:App\Models\Deposits,id'],
            // 'user_id' => ['nullable', 'exists:App\Models\User,id'],
            'amount' => ['nullable', 'int'],
            'note' => ['nullable', 'string'],
            'status' => ['nullable', new EnumValue(DepositsStatus::class, false)],
   
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
            'id' => ['required', 'exists:App\Models\Deposits,id'],
        ];
    }
}
