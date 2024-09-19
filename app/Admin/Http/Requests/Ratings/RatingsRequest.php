<?php

namespace App\Admin\Http\Requests\Ratings;

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
            'feedback' => ['nullable', 'string'],
            'picture' => ['nullable'],
            'lake_id' => ['nullable', 'int'],
            'lakechild_id' => ['nullable', 'int'],
            'booking_id' => ['required', 'int'],
            'lake_id.*' => ['nullable', 'exists:App\Models\Lakes,id'],
            'lakechild_id.*' => ['nullable', 'exists:App\Models\Lakechilds,id'],
            'booking_id.*' => ['nullable', 'exists:App\Models\Bookings,id'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Ratings,id'],
            'rate' => ['nullable', 'int'],
            'status' => ['nullable', 'int'],
            'feedback' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
            'picture' => ['nullable'],
            'lake_id' => ['required', 'int'],
            'lakechild_id' => ['required', 'int'],
            'booking_id' => ['required', 'int'],
            'lake_id.*' => ['required', 'exists:App\Models\Lakes,id'],
            'lakechild_id.*' => ['required', 'exists:App\Models\Lakechilds,id'],
            'booking_id.*' => ['required', 'exists:App\Models\Bookings,id'],
        ];
    }
}
