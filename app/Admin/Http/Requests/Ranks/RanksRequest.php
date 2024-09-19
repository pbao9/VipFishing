<?php

namespace App\Admin\Http\Requests\Ranks;

use App\Admin\Http\Requests\BaseRequest;

class RanksRequest extends BaseRequest
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
                    'hcv_point' => ['nullable', 'int'],
                    'ccv_point' => ['nullable', 'int'],
                    'round' => ['nullable', 'int'],
                    'awards' => ['nullable', 'int'],
                    'lake' => ['nullable', 'int'],
                    'province' => ['nullable', 'int'],
                    'stauts_comission' => ['nullable', 'int'],
                    'rating' => ['nullable', 'int'],
                    
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Ranks,id'],
            'title' => ['nullable', 'string'],
                    'hcv_point' => ['nullable', 'int'],
                    'ccv_point' => ['nullable', 'int'],
                    'round' => ['nullable', 'int'],
                    'awards' => ['nullable', 'int'],
                    'lake' => ['nullable', 'int'],
                    'province' => ['nullable', 'int'],
                    'stauts_comission' => ['nullable', 'int'],
                    'rating' => ['nullable', 'int'],
                    
        ];
    }
}