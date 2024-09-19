<?php

namespace App\Admin\Http\Requests\UserEvents;

use App\Admin\Http\Requests\BaseRequest;

class UserEventsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // protected function methodPost()
    // {
    //     return [
    //         'event_id' => ['nullable', 'int'],
    //         'user_id' => ['nullable', 'int'],
    //         'has_reward' => ['nullable', 'int'],
    //     ];
    // }

    // protected function methodPut()
    // {
    //     return [
    //         'id' => ['required', 'exists:App\Models\UserEvents,id'],
    //         'event_id' => ['nullable', 'int'],
    //         'user_id' => ['nullable', 'int'],
    //         'has_reward' => ['nullable', 'int'],
    //     ];
    // }
}