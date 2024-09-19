<?php

namespace App\Observers;

use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Enums\Notifications\NotificationStatus;
use App\Enums\TransactionHistory\TransactionHistoryType;
use App\Models\Compensations;

class CompensationObserver
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
     * Handle the Compensations "created" event.
     *
     * @param  \App\Models\Compensations  $compensations
     * @return void
     */
    public function created(Compensations $compensation)
    {
        $balance = $compensation->user->balance;
        $balance->update(['total_balance' => $balance->total_balance + $compensation->amount]);

        $this->transactionHistoryRepository->create([
            'user_id' => $compensation->user_id,
            'transaction_type' => TransactionHistoryType::Compensation,
            'amount' => $compensation->amount,
            'balance_after' => $balance->total_balance,
        ]);

        $this->notificationRepository->create([
            'title' => 'Đã nhận tiền bồi thường',
            'content' => 'Số tiền bồi thường được nhận ' . number_format($compensation->amount, 0, ',', '.') . 'VNĐ',
            'user_id' => $compensation->user_id,
            'admin_id' => auth('admin')->user()->id,
            'status' => NotificationStatus::Not_Seen
        ]);
    }

    /**
     * Handle the Compensations "updated" event.
     *
     * @param  \App\Models\Compensations  $compensations
     * @return void
     */
    public function updated(Compensations $compensations)
    {
        //
    }

    /**
     * Handle the Compensations "deleted" event.
     *
     * @param  \App\Models\Compensations  $compensations
     * @return void
     */
    public function deleted(Compensations $compensations)
    {
        //
    }

    /**
     * Handle the Compensations "restored" event.
     *
     * @param  \App\Models\Compensations  $compensations
     * @return void
     */
    public function restored(Compensations $compensations)
    {
        //
    }

    /**
     * Handle the Compensations "force deleted" event.
     *
     * @param  \App\Models\Compensations  $compensations
     * @return void
     */
    public function forceDeleted(Compensations $compensations)
    {
        //
    }
}
