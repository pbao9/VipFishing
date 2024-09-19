<?php

namespace App\Admin\Http\Requests\TransactionHistory;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\TransactionHistory\TransactionHistoryType;
use BenSampo\Enum\Rules\EnumValue;

class TransactionHistoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // protected function methodPost()
    // {
    //     return [
    //         'user_id' => ['required', 'exists:App\Models\User,id'],
    //         'transaction_type' => ['required', new EnumValue(TransactionHistoryType::class, false)],
    //         'amount' => ['required', 'int'],
    //     ];
    // }

    // protected function methodPut()
    // {
    //     return [
    //         'id' => ['required', 'exists:App\Models\TransactionHistory,id'],
    //         'user_id' => ['required', 'exists:App\Models\User,id'],
    //         'transaction_type' => ['required', new EnumValue(TransactionHistoryType::class, false)],
    //         'amount' => ['required', 'int'],
    //     ];
    // }
}