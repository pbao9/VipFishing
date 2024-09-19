<?php

namespace App\Observers;

use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Enums\Notifications\NotificationStatus;
use App\Models\CommissionHistory;

class CommissionObserver
{
    protected $transactionHistoryRepository;
    protected $notificationRepository;

    public function __construct(
        TransactionHistoryRepositoryInterface $transactionHistoryRepository,
        NotificationsRepositoryInterface $notificationRepository
    ) {
        $this->transactionHistoryRepository = $transactionHistoryRepository;
        $this->notificationRepository = $notificationRepository;
    }
    
    /**
     * Handle the CommissionHistory "created" event.
     *
     * @param  \App\Models\CommissionHistory  $commissionHistory
     * @return void
     */
    public function created(CommissionHistory $commissionHistory)
    {
        $balance = $commissionHistory->user->balance;
        $balance->update(['total_balance' => $balance->total_balance + $commissionHistory->amount]);

        $this->transactionHistoryRepository->create([
            'user_id' => $commissionHistory->user_id,
            'transaction_type' => $commissionHistory->type,
            'amount' => $commissionHistory->amount,
            'balance_after' => $balance->total_balance,
        ]);

        $this->notificationRepository->create([
            'title' => 'Đã nhận tiền hoa hồng',
            'content' => 'Số tiền hoa hồng được nhận ' . number_format($commissionHistory->amount, 0, ',', '.') . 'VNĐ',
            'user_id' => $commissionHistory->user_id,
            'admin_id' => auth('admin')->user()->id,
            'status' => NotificationStatus::Not_Seen
        ]);
    }

    /**
     * Handle the CommissionHistory "updated" event.
     *
     * @param  \App\Models\CommissionHistory  $commissionHistory
     * @return void
     */
    public function updated(CommissionHistory $commissionHistory)
    {
        //
    }

    /**
     * Handle the CommissionHistory "deleted" event.
     *
     * @param  \App\Models\CommissionHistory  $commissionHistory
     * @return void
     */
    public function deleted(CommissionHistory $commissionHistory)
    {
        //
    }

    /**
     * Handle the CommissionHistory "restored" event.
     *
     * @param  \App\Models\CommissionHistory  $commissionHistory
     * @return void
     */
    public function restored(CommissionHistory $commissionHistory)
    {
        //
    }

    /**
     * Handle the CommissionHistory "force deleted" event.
     *
     * @param  \App\Models\CommissionHistory  $commissionHistory
     * @return void
     */
    public function forceDeleted(CommissionHistory $commissionHistory)
    {
        //
    }
}
