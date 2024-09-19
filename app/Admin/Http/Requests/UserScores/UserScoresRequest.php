<?php

namespace App\Admin\Http\Requests\UserScores;

use App\Admin\Http\Requests\BaseRequest;

class UserScoresRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'user_id' => ['nullable', 'int'],
            'total_ccv' => ['nullable', 'int'],
            'total_round' => ['nullable', 'int'],
            'total_hcv' => ['nullable', 'int'],
            'total_awards' => ['nullable', 'int'],
            'total_lake' => ['nullable', 'int'],
            'total_province' => ['nullable', 'int'],
            'total_rating' => ['nullable', 'int'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\UserScores,id'],
            'user_id' => ['nullable', 'int'],
            'total_ccv' => ['nullable', 'int'],
            'total_round' => ['nullable', 'int'],
            'total_hcv' => ['nullable', 'int'],
            'total_awards' => ['nullable', 'int'],
            'total_lake' => ['nullable', 'int'],
            'total_province' => ['nullable', 'int'],
            'total_rating' => ['nullable', 'int'],
        ];
    }
}