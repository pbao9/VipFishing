<?php

namespace App\Admin\Http\Requests\LakeChildRatings;

use App\Admin\Http\Requests\BaseRequest;

class LakeChildRatingsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'status' => ['nullable', 'int'],
            'feedback' => ['nullable', 'string'],
            'lakechild_id' => ['required', 'int'],
            'booking_id' => ['required', 'int'],
            'lakechild_id.*' => ['required', 'exists:App\Models\Lakechilds,id'],
            'booking_id.*' => ['required', 'exists:App\Models\Bookings,id'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Ratings,id'],
            'status' => ['nullable', 'int'],
            'feedback' => ['nullable', 'string'],
            'lakechild_id' => ['required', 'int'],
            'booking_id' => ['required', 'int'],
            'lakechild_id.*' => ['required', 'exists:App\Models\Lakechilds,id'],
            'booking_id.*' => ['required', 'exists:App\Models\Bookings,id'],
        ];
    }
}
