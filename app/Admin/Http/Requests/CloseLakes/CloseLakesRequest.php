<?php

namespace App\Admin\Http\Requests\CloseLakes;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\CloseLakes\CloseLakesFishingStatus;
use App\Enums\CloseLakes\CloseLakesPaymentStatus;
use BenSampo\Enum\Rules\EnumValue;

class CloseLakesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'lakechild_id' => ['required', 'exists:App\Models\Lakechilds,id'],
            'close_date' => ['nullable', 'string'],
            'open_date' => ['nullable', 'string'],
            'close_days' => ['nullable', 'string'],
            'canceled_bookings' => ['nullable', 'string'],
            'total_refund_amount' => ['nullable', 'numeric'],
            'compensation_amount' => ['nullable', 'numeric']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\CloseLakes,id'],
            'lakechild_id' => ['required', 'exists:App\Models\Lakechilds,id'],
            'close_date' => ['nullable', 'string'],
            'open_date' => ['nullable', 'string'],
            'close_days' => ['nullable', 'string'],
            'canceled_bookings' => ['nullable', 'string'],
            'total_refund_amount' => ['nullable', 'numeric'],
            'compensation_amount' => ['nullable', 'numeric']
        ];
    }
}
