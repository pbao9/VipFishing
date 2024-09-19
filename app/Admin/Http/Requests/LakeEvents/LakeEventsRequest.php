<?php

namespace App\Admin\Http\Requests\LakeEvents;

use App\Admin\Http\Requests\BaseRequest;

class LakeEventsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'event_id' => ['nullable', 'int'],
                    'lakeChild_id' => ['nullable', 'int'],
                    
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\LakeEvents,id'],
            'event_id' => ['nullable', 'int'],
                    'lakeChild_id' => ['nullable', 'int'],
                    
        ];
    }
}