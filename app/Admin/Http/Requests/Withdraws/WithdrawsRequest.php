<?php

namespace App\Admin\Http\Requests\Withdraws;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\TransactionHistory\TransactionHistoryType;
use App\Enums\Withdraws\WithdrawsStatus;
use BenSampo\Enum\Rules\EnumValue;

class WithdrawsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'user_id' => ['required', 'exists:App\Models\User,id'],
            'amount' => ['required', 'int'],
            'note' => ['nullable', 'string'],
            'other_bank' => ['nullable', 'int'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
            'license' => ['nullable', 'string'],
            'admin_license' => ['nullable', 'string'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Withdraws,id'],
            'amount' => ['required', 'int'],
            'note' => ['nullable', 'string'],
            'status' => ['nullable', new EnumValue(WithdrawsStatus::class, false)],
            'other_bank' => ['nullable', 'int'],
            'bank_id' => ['nullable', 'exists:App\Models\Banks,id'],
            'bank_number' => ['nullable', 'string'],
            'license' => ['nullable', 'string'],
            'admin_license' => ['nullable', 'string'],
        ];
    }
}