<?php

namespace App\Admin\Http\Requests\Role;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Role\RoleeStatus;

class RoleRequest extends BaseRequest
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
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Role,id'],
            'title' => ['required', 'string'],
            'name' => ['required', 'string'],
			'guard_name' => ['required', 'string'],
        ];
    }
}