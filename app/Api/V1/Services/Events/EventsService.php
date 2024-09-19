<?php

namespace App\Api\V1\Services\Events;

use App\Admin\Services\File\FileService;
use App\Admin\Traits\Setup;
use App\Api\V1\Services\Events\EventsServiceInterface;
use App\Api\V1\Repositories\Events\EventsRepositoryInterface;
use App\Api\V1\Repositories\Ranks\RanksRepository;
use App\Api\V1\Repositories\Ranks\RanksRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Enums\Events\EventStatus;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EventsService implements EventsServiceInterface
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
    protected $userRepository;
    protected $ranksRepository;
    protected FileService $fileService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        RanksRepositoryInterface $ranksRepository,
        EventsRepositoryInterface $repository,
        FileService $fileService,
    ) {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->ranksRepository = $ranksRepository;
        $this->fileService = $fileService;
    }

    public function add(Request $request)
    {
        try {
            $this->data = $request->validated();
            $user = $request->user();
            $this->data['user_id'] = $user->id;
            // Rank Đặc cấp đài sư
            $rank = $this->ranksRepository->find(6);
            $currentDate = Carbon::now()->format('Y-m-d');

            if (isset($this->data['start_date']) && $this->data['start_date'] === $currentDate) {
                $this->data['status'] = EventStatus::Ongoing;
            } else {
                $this->data['status'] = EventStatus::NotStarted;
            }

            if ($user->rank_id != $rank->id) {
                return response()->json([
                    'status' => 403,
                    'message' => __('Bạn không có quyền tạo sự kiện (Yêu cầu rank Đặc cấp đài sư)')
                ], 403);
            }

            try {
                $this->data['code'] = $this->createCodeUser();

                if (isset($this->data['picture'])) {
                    $picture = $this->data['picture'];
                    $this->data['picture'] = $this->fileService->uploadAvatar('images', $picture, $this->data['picture']);
                }

                $result = $this->repository->create($this->data);
                if ($result) {
                    return response()->json([
                        'status' => 200,
                        'message' => __('Đã tạo sự kiện thành công!')
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 400,
                    'message' => __('Thêm thất bại. Hãy kiểm tra lại.')
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Có lỗi xảy ra, vui lòng thử lại sau.' . $e->getMessage()),
            ], 500);
        }
    }


    public function edit(Request $request)
    {
        $this->data = $request->validated();
        try {
            $event = $this->repository->find($this->data['id']);

            $currentDate = now();

            if ($event->status == EventStatus::Finished) {
                return response()->json([
                    'status' => 400,
                    'message' => __('Sự kiện đã kết thúc.')
                ], 400);
            } elseif ($currentDate->gte($event->start_date) && $currentDate->lt($event->end_date)) {
                return response()->json([
                    'status' => 400,
                    'message' => __('Sự kiện đang diễn ra.')
                ], 400);
            }

            $this->repository->update($this->data['id'], $this->data);
            return response()->json([
                'status' => 200,
                'message' => __('Sửa thành công.')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => __('Sửa thất bại. Hãy kiểm tra lại.')
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        $this->data = $request->validated();
        try {
            $this->repository->delete($this->data['id']);
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
