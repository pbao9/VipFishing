<?php

namespace App\Api\V1\Http\Requests\Events;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Events\EventStatus;
use BenSampo\Enum\Rules\EnumValue;

class EventsRequest extends BaseRequest
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
            'title' => ['required', 'string'],
            'picture' => ['nullable'],
            'reward' => ['nullable', 'string'],
            'reward_value' => ['nullable', 'int'],
            'reward_quantity' => ['nullable', 'int'],
            'start_date' => ['nullable', 'string'],
            'end_date' => ['nullable', 'string'],
            'events_condition' => ['nullable', 'int'],
            'ccv_point' => ['nullable', 'int'],
            'status' => ['nullable', new EnumValue(EventStatus::class, false)],
            'rank_id' => ['nullable', 'exists:App\Models\Ranks,id'],
            'user_id' => ['nullable', 'exists:App\Models\User,id'],
            'lakechild_id' => ['required', 'exists:App\Models\Lakechilds,id'],
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
            'id' => ['required', 'exists:App\Models\Events,id'],
            'title' => ['required', 'string'],
            'picture' => ['nullable', 'string'],
            'reward' => ['nullable', 'string'],
            'reward_value' => ['nullable', 'int'],
            'reward_quantity' => ['nullable', 'int'],
            'start_date' => ['nullable', 'string'],
            'end_date' => ['nullable', 'string'],
            'events_condition' => ['nullable', 'int'],
            'ccv_point' => ['nullable', 'int'],
            'status' => ['nullable', new EnumValue(EventStatus::class, false)],
            'rank_id' => ['nullable', 'exists:App\Models\Ranks,id'],
            'user_id' => ['required', 'exists:App\Models\User,id'],
            'lakechild_id' => ['required', 'exists:App\Models\Lakechilds,id'],
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
            'id' => ['required', 'exists:App\Models\Events,id'],
        ];
    }
}