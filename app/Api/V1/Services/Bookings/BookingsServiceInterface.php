<?php

namespace App\Api\V1\Services\Bookings;

use Illuminate\Http\Request;

interface BookingsServiceInterface
{
    /**
     * Tạo mới
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function add(Request $request);


    /**
     * Huỷ
     * 
     * @var int $id
     * 
     * @return mixed
     */
    public function delete($id);

    /**
     * Thanh toán
     * 
     * @var int $id
     * 
     * @return mixed
     */
    public function payment(Request $request);
}
