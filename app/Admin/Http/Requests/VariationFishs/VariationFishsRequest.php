<?php

namespace App\Admin\Http\Requests\VariationFishs;

use App\Admin\Http\Requests\BaseRequest;

class VariationFishsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'fish_id' => ['nullable', 'int'],
            'fish_density' => ['nullable', 'numeric'],
            'fish_price' => ['nullable', 'int'],
                    
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\VariationFishs,id'],
            'fish_id' => ['nullable', 'int'],
            'fish_density' => ['nullable', 'numeric'],
            'fish_price' => ['nullable', 'int'],
                    
        ];
    }
}