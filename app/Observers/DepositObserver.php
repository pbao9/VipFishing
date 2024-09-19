<?php

namespace App\Observers;

use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Enums\Deposits\DepositsStatus;
use App\Enums\Notifications\NotificationStatus;
use App\Models\Deposits;

class DepositObserver
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
     * Handle the Deposits "created" event.
     *
     * @param  \App\Models\Deposits  $deposits
     * @return void
     */
    public function created(Deposits $deposits)
    {
        //
    }

    /**
     * Handle the Deposits "updated" event.
     *
     * @param  \App\Models\Deposits  $deposits
     * @return void
     */
    public function updated(Deposits $deposit)
    {
        if ($deposit->status == DepositsStatus::Completed) {
            $balance = $deposit->user->balance;
            $balance->update(['total_balance' => $balance->total_balance + $deposit->amount]);

            $this->transactionHistoryRepository->create([
                'user_id' => $deposit->user_id,
                'transaction_type' => $deposit->type,
                'amount' => $deposit->amount,
                'balance_after' => $balance->total_balance,
            ]);

            $this->notificationRepository->create([
                'title' => 'Nạp tiền thành công',
                'content' => 'Bạn đã nạp thành công số tiền ' . number_format($deposit->amount, 0, ',', '.') . 'VNĐ',
                'user_id' => $deposit->user_id,
                'admin_id' => $deposit->admin_id,
                'status' => NotificationStatus::Not_Seen
            ]);
        }
    }

    /**
     * Handle the Deposits "deleted" event.
     *
     * @param  \App\Models\Deposits  $deposits
     * @return void
     */
    public function deleted(Deposits $deposits)
    {
        //
    }

    /**
     * Handle the Deposits "restored" event.
     *
     * @param  \App\Models\Deposits  $deposits
     * @return void
     */
    public function restored(Deposits $deposits)
    {
        //
    }

    /**
     * Handle the Deposits "force deleted" event.
     *
     * @param  \App\Models\Deposits  $deposits
     * @return void
     */
    public function forceDeleted(Deposits $deposits)
    {
        //
    }
}
