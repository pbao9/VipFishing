<?php

namespace App\Api\V1\Services\TransactionHistory;

use Illuminate\Http\Request;

interface TransactionHistoryServiceInterface
{
    /**
     * Xóa
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function delete($id);

}