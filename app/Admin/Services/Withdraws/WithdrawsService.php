<?php

namespace App\Admin\Services\Withdraws;

use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Admin\Services\Withdraws\WithdrawsServiceInterface;
use App\Admin\Repositories\Withdraws\WithdrawsRepositoryInterface;
use App\Admin\Traits\Setup;
use App\Enums\Notifications\NotificationStatus;
use App\Enums\Withdraws\WithdrawsStatus;
use Illuminate\Http\Request;

class WithdrawsService implements WithdrawsServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    protected $repository;
    protected $notificationRepository;

    public function __construct(
        WithdrawsRepositoryInterface $repository,
        NotificationsRepositoryInterface $notificationRepository
    ) {
        $this->repository = $repository;
        $this->notificationRepository = $notificationRepository;
    }

    public function store(Request $request)
    {

        $this->data = $request->validated();
        $this->data['code'] = $this->createCodeUser();
        $this->data['status'] = WithdrawsStatus::Pending;
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;

        return $this->repository->create($this->data);
    }

    /*
     * @return any
     */
    public function update(Request $request)
    {

        $this->data = $request->validated();
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;

        $withdraw = $this->repository->find($this->data['id']);

        $balance = $withdraw->user->balance;

        if ($this->data['status'] == WithdrawsStatus::Completed) {
            if ($balance->total_balance < $this->data['amount']) {
                $this->notificationRepository->create([
                    'title' => 'Rút tiền thất bại',
                    'content' => 'Không đủ số dư. Số dư hiện tại ' . number_format($balance->total_balance, 0, ',', '.') . 'VNĐ',
                    'user_id' => $withdraw->user_id,
                    'admin_id' => $admin->id,
                    'status' => NotificationStatus::Not_Seen
                ]);

                return [
                    'success' => false,
                    'message' => __('insufficientBalance')
                ];
            }
        }

        $result = $this->repository->update($this->data['id'], $this->data);

        if ($result) {
            return [
                'id' => $result->id,
                'success' => true,
                'message' => __('notifySuccess')
            ];
        } else {
            return [
                'success' => false,
                'message' => __('notifyFail')
            ];
        }
    }

    public function delete($id)
    {
        return (bool) $this->repository->delete($id);
    }
}
