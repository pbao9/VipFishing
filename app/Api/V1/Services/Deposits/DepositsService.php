<?php

namespace App\Api\V1\Services\Deposits;

use App\Admin\Services\File\FileService;
use App\Api\V1\Services\Deposits\DepositsServiceInterface;
use App\Api\V1\Repositories\Deposits\DepositsRepositoryInterface;
use App\Admin\Traits\Setup;
use App\Api\V1\Support\AuthServiceApi;
use App\Enums\Deposits\DepositsStatus;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;
use App\Api\V1\Support\Response;
use App\Traits\JwtService;
use App\Traits\UseLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DepositsService implements DepositsServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    protected $repository;
    protected FileService $fileService;

    public function __construct(
        DepositsRepositoryInterface $repository,
        FileService $fileService,
    ) {
        $this->repository = $repository;
        $this->fileService = $fileService;
    }

    public function add(Request $request)
    {
        $user = $request->user();
        $this->data = $request->validated();

        $this->data['code'] = $this->createCodeUser();
        $this->data['status'] = DepositsStatus::Pending;
        $this->data['user_id'] = $user->id;

        $this->data['admin_id'] = 1;

        if (isset($user->bank_id) || isset($user->bank_number)) {
            if (isset($this->data['license'])) {
                $license = $this->data['license'];
                $this->data['license'] = $this->fileService->uploadAvatar('images', $license, $this->data['license']);
            } else {
                $this->data['license'] = config('custom.images.default');
            }

            $this->repository->create($this->data);
            return [
                'status' => 200,
                'message' => __('Đã gửi yêu cầu nạp tiền đến quản trị. Vui lòng chờ để xét duyệt!')
            ];
        } else {
            Log::info('Thiếu thông tin', ['Loại thông tin' => $user]);
            return [
                'status' => 422,
                'message' => __('Thiếu thông tin! Vui lòng kiểm tra Số tài khoản và ngân hàng')
            ];
        }
    }

    public function edit(Request $request)
    {
        $this->data = $request->validated();
        $this->data['user_id'] = $request->user()->id;
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;

        return (bool) $this->repository->update($this->data['id'], $this->data);
    }

    public function delete(Request $request)
    {
        $this->data = $request->validated();
        return (bool) $this->repository->delete($this->data['id']);
    }
}
