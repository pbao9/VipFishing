<?php

namespace App\Api\V1\Http\Requests\Bookings;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Bookings\BookingsStatus;
use BenSampo\Enum\Rules\EnumValue;

class BookingsRequest extends BaseRequest
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
            'fishing_date' => ['required', 'string'],
            'lakeChild_id' => ['required', 'exists:App\Models\Lakechilds,id'],
            'fishingset_id' => ['required', 'exists:App\Models\FishingSet,id'],
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
            'id' => ['required', 'exists:App\Models\Bookings,id'],
            'fishing_date' => ['nullable', 'string'],
            'status' => ['nullable', new EnumValue(BookingsStatus::class, false)],
            'lakeChild_id' => ['nullable', 'exists:App\Models\Lakechilds,id'],
            'fishingset_id' => ['nullable', 'exists:App\Models\FishingSet,id'],
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
            'id' => ['required', 'exists:App\Models\Bookings,id'],
        ];
    }
}
