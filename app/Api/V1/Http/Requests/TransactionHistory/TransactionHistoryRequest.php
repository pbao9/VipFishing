<?php

namespace App\Api\V1\Http\Requests\TransactionHistory;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\TransactionHistory\TransactionHistoryType;
use BenSampo\Enum\Rules\EnumValue;

class TransactionHistoryRequest extends BaseRequest
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
    //         'user_id' => ['nullable', 'exists:App\Models\User,id'],
    //         'transaction_type' => ['required', new EnumValue(TransactionHistoryType::class, false)],
    //         'amount' => ['required', 'int'],
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
    //         'id' => ['required', 'exists:App\Models\TransactionHistory,id'],
    //         'user_id' => ['nullable', 'exists:App\Models\User,id'],
    //         'transaction_type' => ['nullable', new EnumValue(TransactionHistoryType::class, false)],
    //         'amount' => ['nullable', 'int'],
    //     ];
    // }

    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array
    //  */
    // protected function methodDelete()
    // {
    //     return [
    //         'id' => ['required', 'exists:App\Models\TransactionHistory,id'],
    //     ];
    // }

}