<?php

namespace App\Api\V1\Services\User;
use Illuminate\Http\Request;

interface UserServiceInterface
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
     * Cập nhật
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return boolean
     */
    public function edit(Request $request);
    /**
     * Xóa
     *  
     * @var Illuminate\Http\Request $request
     * 
     * @return boolean
     */
    public function delete(Request $request);

}