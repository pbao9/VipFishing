<?php

namespace App\Api\V1\Http\Requests\Balances;

use App\Api\V1\Http\Requests\BaseRequest;

class BalancesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'limit' => ['nullable', 'integer', 'min:1']
        ];
    }

    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array
    //  */
    // protected function methodPost()
    // {
    //     return [
    //         'user_id' => ['required', 'int'],
    //         'total_balance' => ['required', 'int'],
    //     ];
    // }


    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array
    //  */
    // protected function methodPut()
    // {
    //     return [
    // 		'id' => ['required', 'exists:App\Models\Balances,id'],
    //         'user_id' => ['nullable', 'int'],
    //         'total_balance' => ['nullable', 'int'],
    //     ];
    // }

    // 	/**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array
    //  */
    // protected function methodDelete()
    // {
    //     return [
    // 		'id' => ['required', 'exists:App\Models\Balances,id'],       
    //     ];
    // }

}