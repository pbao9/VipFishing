<?php

namespace App\Admin\Http\Requests\Balances;

use App\Admin\Http\Requests\BaseRequest;

class BalancesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // protected function methodPost()
    // {
    //     return [
    //         'user_id' => ['required', 'exists:App\Models\User,id'],
    //         'total_balance' => ['required', 'int'],

    //     ];
    // }

    // protected function methodPut()
    // {
    //     return [
    //         'id' => ['required', 'exists:App\Models\Balances,id'],
    //         'user_id' => ['required', 'exists:App\Models\User,id'],
    //         'total_balance' => ['required', 'int'],
    //     ];
    // }
}