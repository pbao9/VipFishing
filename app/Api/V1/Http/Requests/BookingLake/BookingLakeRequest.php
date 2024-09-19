<?php

namespace App\Api\V1\Http\Requests\BookingLake;

use App\Api\V1\Http\Requests\BaseRequest;

class BookingLakeRequest extends BaseRequest
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
    //         'booking_id' => ['nullable', 'int'],
    //         'variationFishs_id' => ['nullable', 'int'],
    //         'total_price' => ['nullable', 'int'],

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
    // 		'id' => ['required', 'exists:App\Models\BookingLake,id'],
    //         'booking_id' => ['nullable', 'int'],
    //         'variationFishs_id' => ['nullable', 'int'],
    //         'total_price' => ['nullable', 'int'],

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
    // 		'id' => ['required', 'exists:App\Models\BookingLake,id'],       
    //     ];
    // }

}