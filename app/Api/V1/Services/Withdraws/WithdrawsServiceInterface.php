<?php

namespace App\Api\V1\Services\Withdraws;
use Illuminate\Http\Request;

interface WithdrawsServiceInterface
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
     * @var int $id
     * 
     * @return mixed
     */
	public function delete($id);
}