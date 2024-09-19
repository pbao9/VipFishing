<?php

namespace App\Api\V1\Http\Requests\Withdraws;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Withdraws\WithdrawsStatus;
use BenSampo\Enum\Rules\EnumValue;

class WithdrawsRequest extends BaseRequest
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
            'other_bank' => ['nullable', 'int'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
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
            'id' => ['required', 'exists:App\Models\Withdraws,id'],
            // 'user_id' => ['nullable', 'exists:App\Models\User,id'],
            'amount' => ['nullable', 'int'],
            'note' => ['nullable', 'string'],
            'status' => ['nullable', new EnumValue(WithdrawsStatus::class, false)],
            'other_bank' => ['nullable', 'int'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
            'license' => ['nullable', 'string'],
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
            'id' => ['required', 'exists:App\Models\Withdraws,id'],
        ];
    }
}
