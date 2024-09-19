<?php

namespace App\Admin\Http\Requests\LakeRatings;

use App\Admin\Http\Requests\BaseRequest;

class RatingsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'rate' => ['nullable', 'int'],
            'note' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],
            'picture' => ['nullable'],
            'lake_id' => ['required', 'int'],
            'booking_id' => ['required', 'int'],
            'lake_id.*' => ['required', 'exists:App\Models\Lakes,id'],
            'booking_id.*' => ['required', 'exists:App\Models\Bookings,id'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Ratings,id'],
            'rate' => ['nullable', 'int'],
            'status' => ['nullable', 'int'],
            'note' => ['nullable', 'string'],
            'picture' => ['nullable'],
            'lake_id' => ['required', 'int'],
            'booking_id' => ['required', 'int'],
            'lake_id.*' => ['required', 'exists:App\Models\Lakes,id'],
            'booking_id.*' => ['required', 'exists:App\Models\Bookings,id'],
        ];
    }
}
