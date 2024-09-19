<?php

namespace App\Api\V1\Http\Requests\CommissionHistory;

use App\Api\V1\Http\Requests\BaseRequest;

class CommissionHistoryRequest extends BaseRequest
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
    //         'amount' => ['required', 'int'],
    //         'user_id' => ['nullable', 'exists:App\Models\User,id'],
    //         'booking_id' => ['required', 'exists:App\Models\Bookings,id'],
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
    //         'id' => ['required', 'exists:App\Models\CommissionHistory,id'],
    //         'amount' => ['nullable', 'int'],
    //         'user_id' => ['nullable', 'exists:App\Models\User,id'],
    //         'booking_id' => ['nullable', 'exists:App\Models\Bookings,id'],
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
    //         'id' => ['required', 'exists:App\Models\CommissionHistory,id'],
    //     ];
    // }

}