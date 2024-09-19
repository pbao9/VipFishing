<?php

namespace App\Admin\Http\Requests\PostCategory;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\PostCategory\PostCategoryStatus;
use BenSampo\Enum\Rules\EnumValue;
use App\Admin\Rules\Category\CategoryParent;

class PostCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:App\Models\PostCategory,id'],
            'position' => ['required', 'integer'],
            'status' => ['required', new EnumValue(PostCategoryStatus::class, false)]
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\PostCategory,id'],
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:App\Models\PostCategory,id', new CategoryParent($this->id)],
            'position' => ['nullable', 'integer'],
            'status' => ['required', new EnumValue(PostCategoryStatus::class, false)]
        ];
    }
}