<?php

namespace App\Api\V1\Services\Ratings;

use Illuminate\Http\Request;

interface RatingsServiceInterface
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
     * Sửa
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function edit(Request $request);

    /**
     * Xóa
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function delete(Request $request);
}