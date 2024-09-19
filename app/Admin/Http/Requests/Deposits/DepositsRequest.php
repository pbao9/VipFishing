<?php

namespace App\Admin\Http\Requests\Deposits;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Deposits\DepositsStatus;
use BenSampo\Enum\Rules\EnumValue;

class DepositsRequest extends BaseRequest
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
            'type' => ['nullable'],
            'booking_id' => ['nullable', 'exists:App\Models\Bookings,id'],
            'note' => ['nullable', 'string'],
            'license' => ['nullable', 'string'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Deposits,id'],
            'amount' => ['required', 'int'],
            'note' => ['nullable', 'string'],
            'type' => ['nullable'],
            'booking_id' => ['nullable', 'exists:App\Models\Bookings,id'],
            'status' => ['nullable', new EnumValue(DepositsStatus::class, false)],
            'license' => ['nullable', 'string'],
        ];
    }
}
