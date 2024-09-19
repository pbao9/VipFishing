<?php

namespace App\Admin\Http\Requests\Slider;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Slider\SliderStatus;

class SliderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'status' => ['required', new EnumValue(SliderStatus::class, false)],
            'name' => ['required', 'string'],
            'plain_key' => ['required', 'string', 'unique:App\Models\Slider,plain_key'],
            'desc' => ['nullable'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Slider,id'],
            'status' => ['required', new EnumValue(SliderStatus::class, false)],
            'name' => ['required', 'string'],
            'plain_key' => ['required', 'string', 'unique:App\Models\Slider,plain_key,'.$this->id],
            'desc' => ['nullable'],
        ];
    }
}