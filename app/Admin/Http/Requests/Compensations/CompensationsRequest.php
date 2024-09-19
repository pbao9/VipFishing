<?php

namespace App\Admin\Http\Requests\Compensations;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\TransactionHistory\TransactionHistoryType;
use BenSampo\Enum\Rules\EnumValue;

class CompensationsRequest extends BaseRequest
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
    //         'booking_id' => ['required', 'exists:App\Models\Bookings,id'],
    //         'user_id' => ['required', 'exists:App\Models\User,id'],
    //         'type' => ['nullable', new EnumValue(TransactionHistoryType::class, false)],

    //     ];
    // }

    // protected function methodPut()
    // {
    //     return [
    //         'id' => ['required', 'exists:App\Models\Compensations,id'],
    //         'amount' => ['required', 'int'],
    //         'booking_id' => ['required', 'exists:App\Models\Bookings,id'],
    //         'user_id' => ['required', 'exists:App\Models\User,id'],
    //         'type' => ['nullable', new EnumValue(TransactionHistoryType::class, false)],

    //     ];
    // }
}
