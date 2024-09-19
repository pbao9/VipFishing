<?php

namespace App\Admin\Http\Requests\AttributeVariation;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;

class AttributeVariationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'attribute_id' => ['required', 'exists:App\Models\Attribute,id'],
            'name' => ['required', 'string'],
            'position' => ['required', 'integer'],
            'meta_value' => ['nullable', 'array'],
            'meta_value[color]' => ['nullable'],
            'desc' => ['nullable'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\AttributeVariation,id'],
            'name' => ['required', 'string'],
            'position' => ['required', 'integer'],
            'meta_value' => ['nullable', 'array'],
            'meta_value[color]' => ['nullable'],
            'desc' => ['nullable'],
        ];
    }
}