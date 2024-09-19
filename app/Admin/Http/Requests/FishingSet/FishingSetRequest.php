<?php

namespace App\Admin\Http\Requests\FishingSet;

use App\Admin\Http\Requests\BaseRequest;

class FishingSetRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'title' => ['nullable', 'string'],
            'time_start' => ['nullable', 'string'],
            'time_end' => ['nullable', 'string'],
            'time_checkin' => ['nullable', 'string'],
            'duration' => ['nullable', 'int'],

        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\FishingSet,id'],
            'title' => ['nullable', 'string'],
            'time_start' => ['nullable', 'string'],
            'time_end' => ['nullable', 'string'],
            'time_checkin' => ['nullable', 'string'],
            'duration' => ['nullable', 'int'],
        ];
    }
}
