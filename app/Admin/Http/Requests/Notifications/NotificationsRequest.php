<?php

namespace App\Admin\Http\Requests\Notifications;

use App\Admin\Http\Requests\BaseRequest;

class NotificationsRequest extends BaseRequest
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
                    'content' => ['nullable', 'string'],
                    'status' => ['nullable', 'int'],
                    'user_id' => ['nullable', 'int'],
                    'admin_id' => ['nullable', 'int'],
                    
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Notifications,id'],
            'title' => ['nullable', 'string'],
                    'content' => ['nullable', 'string'],
                    'status' => ['nullable', 'int'],
                    'user_id' => ['nullable', 'int'],
                    'admin_id' => ['nullable', 'int'],
                    
        ];
    }
}