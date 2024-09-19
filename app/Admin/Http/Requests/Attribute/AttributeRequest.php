<?php

namespace App\Admin\Http\Requests\Attribute;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Attribute\AttributeType;

class AttributeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'type' => ['required', new EnumValue(AttributeType::class, false)],
            'name' => ['required', 'string'],
            'position' => ['required', 'integer'],
            'desc' => ['nullable'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Attribute,id'],
            'type' => ['required', new EnumValue(AttributeType::class, false)],
            'name' => ['required', 'string'],
            'position' => ['required', 'integer'],
            'desc' => ['nullable'],
        ];
    }
}