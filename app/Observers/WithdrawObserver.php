<?php

namespace App\Observers;

use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Enums\Notifications\NotificationStatus;
use App\Enums\Withdraws\WithdrawsStatus;
use App\Models\Withdraws;

class WithdrawObserver
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
     * Handle the Withdraws "created" event.
     *
     * @param  \App\Models\Withdraws  $withdraws
     * @return void
     */
    public function created(Withdraws $withdraws)
    {
        //
    }

    /**
     * Handle the Withdraws "updated" event.
     *
     * @param  \App\Models\Withdraws  $withdraws
     * @return void
     */
    public function updated(Withdraws $withdraw)
    {
        if ($withdraw->status == WithdrawsStatus::Completed) {
            $balance = $withdraw->user->balance;
            $balance->update(['total_balance' => $balance->total_balance - $withdraw->amount]);

            $this->transactionHistoryRepository->create([
                'user_id' => $withdraw->user_id,
                'transaction_type' => $withdraw->type,
                'amount' => $withdraw->amount,
                'balance_after' => $balance->total_balance,
            ]);

            $this->notificationRepository->create([
                'title' => 'Rút tiền thành công',
                'content' => 'Bạn đã rút thành công số tiền ' . number_format($withdraw->amount, 0, ',', '.') . 'VNĐ',
                'user_id' => $withdraw->user_id,
                'admin_id' => $withdraw->admin_id,
                'status' => NotificationStatus::Not_Seen
            ]);
        }
    }

    /**
     * Handle the Withdraws "deleted" event.
     *
     * @param  \App\Models\Withdraws  $withdraws
     * @return void
     */
    public function deleted(Withdraws $withdraws)
    {
        //
    }

    /**
     * Handle the Withdraws "restored" event.
     *
     * @param  \App\Models\Withdraws  $withdraws
     * @return void
     */
    public function restored(Withdraws $withdraws)
    {
        //
    }

    /**
     * Handle the Withdraws "force deleted" event.
     *
     * @param  \App\Models\Withdraws  $withdraws
     * @return void
     */
    public function forceDeleted(Withdraws $withdraws)
    {
        //
    }
}
