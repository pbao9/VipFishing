<?php

namespace App\Api\V1\Services\UserEvents;

use App\Api\V1\Repositories\Events\EventsRepositoryInterface;
use App\Api\V1\Services\UserEvents\UserEventsServiceInterface;
use App\Api\V1\Repositories\UserEvents\UserEventsRepositoryInterface;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Events\EventStatus;

class UserEventsService implements UserEventsServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $eventsRepository;

    public function __construct(
        UserEventsRepositoryInterface $repository,
        EventsRepositoryInterface $eventsRepository,
    ) {
        $this->repository = $repository;
        $this->eventsRepository = $eventsRepository;
    }

    public function add(Request $request)
    {
        $this->data = $request->validated();
        $event = $this->eventsRepository->find($this->data['event_id']);
        $eventCondition = $event->events_condition;
        $requiredCCVPoints = $event->ccv_point;
        $requiredRank = $event->rank_id;

        $user = $request->user();
        $this->data['user_id'] = $user->id;
        $userCCVPoints = $user->rank->ccv_point;
        $userRank = $user->rank->id;


        if ($this->repository->existUserEvent($user->id)) {
            return response()->json([
                'status' => 401,
                'message' => __('Bạn đã tham gia sự kiện này, mỗi người chỉ được tham gia 1 lần bạn nhé!')
            ]);
        }

        if ($event->status == EventStatus::Ongoing) {
            if ($eventCondition) {
                if (isset($requiredCCVPoints)) {
                    if ($userCCVPoints < $requiredCCVPoints) {
                        return response()->json([
                            'status' => 400,
                            'message' => __('Điểm CCV của bạn không đủ để tham gia sự kiện này.')
                        ], 400);
                    }
                }

                if (isset($requiredRank)) {
                    if ($userRank !== $requiredRank) {
                        return response()->json([
                            'status' => 400,
                            'message' => __('Rank của bạn không phù hợp để tham gia sự kiện này.')
                        ], 400);
                    }
                }
            }

            try {
                $this->repository->create($this->data);
                return response()->json([
                    'status' => 200,
                    'message' => __('Tham gia sự kiện thành công')
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 400,
                    'message' => __('Thêm thất bại. Hãy kiểm tra lại.')
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 400,
                'message' => __('Sự kiện hiện tại không hoạt động! Vui lòng kiểm tra lại')
            ]);
        }
    }

    public function edit(Request $request)
    {
        $this->data = $request->validated();
        try {
            $this->repository->update($this->data['id'], $this->data);
            // Trả về thông báo thành công hoặc dữ liệu đã cập nhật
            return 1;
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return 0;
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
