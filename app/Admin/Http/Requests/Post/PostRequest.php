<?php

namespace App\Admin\Http\Requests\Post;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Post\PostStatus;
use BenSampo\Enum\Rules\EnumValue;

class PostRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'categories_id' => ['nullable', 'array'],
            'categories_id.*' => ['nullable', 'exists:App\Models\PostCategory,id'],
            'title' => ['required', 'string'],
            'image' => ['required'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', new EnumValue(PostStatus::class, false)],
            'excerpt' => ['nullable'],
            'content' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Post,id'],
            'categories_id' => ['nullable', 'array'],
            'categories_id.*' => ['nullable', 'exists:App\Models\PostCategory,id'],
            'title' => ['required', 'string'],
            'image' => ['required'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', new EnumValue(PostStatus::class, false)],
            'excerpt' => ['nullable'],
            'content' => ['nullable']
        ];
    }
}