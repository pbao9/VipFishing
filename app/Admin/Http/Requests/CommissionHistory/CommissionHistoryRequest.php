<?php

namespace App\Admin\Http\Requests\CommissionHistory;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\TransactionHistory\TransactionHistoryType;
use BenSampo\Enum\Rules\EnumValue;

class CommissionHistoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // protected function methodPost()
    // {
    //     return [
    //         'amount' => ['required', 'int'],
    //         'user_id' => ['required', 'exists:App\Models\User,id'],
    //         'booking_id' => ['required', 'exists:App\Models\Bookings,id'],
    //         'type' => ['nullable', new EnumValue(TransactionHistoryType::class, false)],
    //     ];
    // }

    // protected function methodPut()
    // {
    //     return [
    //         'id' => ['required', 'exists:App\Models\CommissionHistory,id'],
    //         'amount' => ['required', 'int'],
    //         'user_id' => ['required', 'exists:App\Models\User,id'],
    //         'booking_id' => ['required', 'exists:App\Models\Bookings,id'],
    //         'type' => ['nullable', new EnumValue(TransactionHistoryType::class, false)],
    //     ];
    // }
}