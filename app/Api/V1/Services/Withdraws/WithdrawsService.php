<?php

namespace App\Api\V1\Services\Withdraws;

use App\Admin\Services\File\FileService;
use App\Api\V1\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Api\V1\Services\Withdraws\WithdrawsServiceInterface;
use App\Api\V1\Repositories\Withdraws\WithdrawsRepositoryInterface;
use App\Admin\Traits\Setup;
use App\Enums\Notifications\NotificationStatus;
use App\Enums\Withdraws\WithdrawsStatus;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;
use Illuminate\Support\Facades\Log;

class WithdrawsService implements WithdrawsServiceInterface
{
    use AuthSupport;
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    protected $repository;
    protected $notificationRepository;
    protected FileService $fileService;

    public function __construct(
        WithdrawsRepositoryInterface $repository,
        NotificationsRepositoryInterface $notificationRepository,
        FileService $fileService,
    ) {
        $this->repository = $repository;
        $this->notificationRepository = $notificationRepository;
        $this->fileService = $fileService;
    }

    public function add(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return [
                "status" => 400,
                "message" => "Vui lòng đăng nhập"
            ];
        }
        $this->data = $request->validated();
        $this->data['code'] = $this->createCodeUser();
        $this->data['status'] = WithdrawsStatus::Pending;
        $this->data['user_id'] = $user->id;
        $this->data['admin_id'] = 1;

        if (isset($this->data['license'])) {
            $license = $this->data['license'];
            $this->data['license'] = $this->fileService->uploadAvatar('images', $license, $this->data['license']);
        } else {
            $this->data['license'] = config('custom.images.default');
        }

        $check = $user->balance->total_balance;
        if ($check >= $this->data['amount']) {
            $this->repository->create($this->data);

            return [
                'status' => 200,
                'message' => __('Yêu cầu rút tiền thành công.'),
            ];
        } else {
            return [
                'status' => 400,
                'message' => __('Số dư không đủ để thực hiện yêu cầu.')
            ];
        }
    }


    public function edit(Request $request)
    {
        $this->data = $request->validated();
        $this->data['user_id'] = $request->user()->id;
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

                return response()->json([
                    'status' => 400,
                    'message' => __('Rút thất bại. Không đủ số dư.')
                ], 400);
            }
        }

        $result = $this->repository->update($this->data['id'], $this->data);

        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => __('Sửa thành công.')
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => __('Sửa thất bại. Hãy kiểm tra lại.')
            ], 400);
        }
    }

    public function delete($id)
    {
        return (bool) $this->repository->delete($id);
    }
}
