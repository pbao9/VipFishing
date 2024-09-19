<?php

namespace App\Admin\Http\Requests\Bookings;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Bookings\BookingsStatus;
use BenSampo\Enum\Rules\EnumValue;

class BookingsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'fishing_date' => ['nullable', 'string'],
            'user_id' => ['nullable', 'exists:App\Models\User,id'],
            'lakeChild_id' => ['required', 'exists:App\Models\Lakechilds,id'],
            'fishingset_id' => ['required', 'exists:App\Models\FishingSet,id'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Bookings,id'],
            'fishing_date' => ['nullable', 'string'],
            'status' => ['nullable', new EnumValue(BookingsStatus::class, false)],
            'lakeChild_id' => ['nullable', 'exists:App\Models\Lakechilds,id'],
            'fishingset_id' => ['nullable', 'exists:App\Models\FishingSet,id'],
        ];
    }
}