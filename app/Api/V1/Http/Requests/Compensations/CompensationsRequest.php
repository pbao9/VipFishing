<?php

namespace App\Api\V1\Http\Requests\Compensations;

use App\Api\V1\Http\Requests\BaseRequest;

class CompensationsRequest extends BaseRequest
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
    //         'booking_id' => ['required', 'exists:App\Models\Bookings,id'],
    //         'user_id' => ['nullable', 'exists:App\Models\User,id'],
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
    //         'id' => ['required', 'exists:App\Models\Compensations,id'],
    //         'amount' => ['nullable', 'int'],
    //         'booking_id' => ['nullable', 'exists:App\Models\Bookings,id'],
    //         'user_id' => ['nullable', 'exists:App\Models\User,id'],
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
    //         'id' => ['required', 'exists:App\Models\Compensations,id'],
    //     ];
    // }

}