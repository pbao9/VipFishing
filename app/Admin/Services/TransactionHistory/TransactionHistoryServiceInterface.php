<?php

namespace App\Admin\Services\TransactionHistory;

interface TransactionHistoryServiceInterface
{
    /**
     * Xóa
     *  
     * @param int $id
     * 
     * @return boolean
     */
    public function delete($id);
}