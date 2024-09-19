<?php

namespace App\Admin\Http\Requests\Permission;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;

class PermissionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'title' => ['required', 'string'],
            'name' => ['required', 'string'],
            'guard_name' => ['required', 'string'],
            'module_id' => ['nullable', 'int'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Permission,id'],
            'title' => ['required', 'string'],
            'name' => ['required', 'string'],
            'guard_name' => ['required', 'string'],
			'module_id' => ['nullable', 'int'],
        ];
    }
}