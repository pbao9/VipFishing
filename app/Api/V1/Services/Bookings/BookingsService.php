<?php

namespace App\Api\V1\Services\Bookings;

use App\Admin\Traits\Setup;
use App\Api\V1\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Api\V1\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Api\V1\Services\Bookings\BookingsServiceInterface;
use App\Api\V1\Repositories\Bookings\BookingsRepositoryInterface;
use App\Api\V1\Repositories\CloseLakes\CloseLakesRepository;
use App\Api\V1\Repositories\CloseLakes\CloseLakesRepositoryInterface;
use App\Api\V1\Services\CloseLakes\CloseLakesServiceInterface;
use App\Enums\Bookings\BookingsStatus;
use App\Enums\Notifications\NotificationStatus;
use App\Models\ActivitySchedule;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Lakechilds\LakechildsStatus;
use App\Models\CloseLakes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingsService implements BookingsServiceInterface
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
    protected $lakeChildRepository;
    protected $closeLakeService;
    protected $closeLakeRepository;
    protected $notificationRepository;

    public function __construct(
        BookingsRepositoryInterface $repository,
        LakechildsRepositoryInterface $lakeChildRepository,
        CloseLakesServiceInterface $closeLakeService,
        CloseLakesRepositoryInterface $closeLakeRepository,
        NotificationsRepositoryInterface $notificationRepository,
    ) {
        $this->repository = $repository;
        $this->lakeChildRepository = $lakeChildRepository;
        $this->closeLakeService = $closeLakeService;
        $this->closeLakeRepository = $closeLakeRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function add(Request $request)
    {
        try {
            $this->data = $request->validated();
            $this->data['user_id'] = $request->user()->id;
            $this->data['status'] = BookingsStatus::Unpaid;

            if ($this->repository->hasPendingOrder($this->data['user_id'])) {
                return response()->json([
                    'status' => 400,
                    'message' => __('Thêm thất bại. Bạn còn đơn đặt câu chưa thanh toán'),
                ], 400);
            }

            $lakechild = $this->lakeChildRepository->find($this->data['lakeChild_id']);

            $currentDate = Carbon::parse($this->data['fishing_date']);
            $closeLake = $this->closeLakeRepository->where('lakechild_id', '=', $lakechild->id)
                ->whereDate('close_date', '<=', $currentDate)
                ->whereDate('open_date', '>=', $currentDate)
                ->first();

            if ($closeLake) {
                $closeDate = Carbon::parse($closeLake->close_date)->format('d/m/Y');
                $openDate = Carbon::parse($closeLake->open_date)->format('d/m/Y');

                return response()->json([
                    'status' => 404,
                    'message' => __('Hồ này đang tạm ngưng từ ngày ' . $closeDate . ' đến ngày ' . $openDate . '. Vui lòng chọn ngày khác.'),
                ], 404);
            }

            $activitySchedule = ActivitySchedule::where('lake_child_id', $lakechild->id)
                ->where('activity_date', $currentDate)
                ->first();

            if (!$activitySchedule) {
                return response()->json([
                    'status' => 404,
                    'message' => __('Hồ không hoạt động vào ngày này. Vui lòng chọn ngày khác.'),
                ], 404);
            }


            $lakeSlots = $lakechild->slot;
            $existingPositions = $this->repository->getBookedPositions($lakechild->id, $this->data['fishingset_id'], $this->data['fishing_date']);
            $availablePositions = array_diff(range(1, $lakeSlots), $existingPositions);

            Log::info('Available positions:', $availablePositions);

            if (empty($availablePositions)) {
                return response()->json([
                    'status' => 400,
                    'message' => __('Thêm thất bại. Không còn vị trí trống trong hồ này'),
                ], 400);
            }

            $this->data['position'] = $availablePositions[array_rand($availablePositions)];
            $this->data['total_price'] = $this->repository->calculateTotalPrice($this->data);


            if ($lakechild->status == LakechildsStatus::closed) {
                return response()->json([
                    'status' => 404,
                    'message' => __('Hồ này đã đóng cửa. Vui lòng đặt hồ khác!'),
                ], 404);
            }

            // Tạo đơn câu
            $this->data['booking_code'] = $this->createCodeBooking();
            $result = $this->repository->create($this->data);

            if ($result) {
                return response()->json([
                    'status' => 200,
                    'message' => __('Đặt đơn thành công! Vui lòng thanh toán.')
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => __('Thêm thất bại. Hãy kiểm tra lại.'),
                ], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error occurred in add method', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 500,
                'message' => __('Có lỗi xảy ra, vui lòng thử lại sau.' . $e->getMessage()),
            ], 500);
        }
    }

    public function delete($id)
    {
        $booking = $this->repository->find($id);
        $status = $booking->status;

        if ($status == BookingsStatus::Unpaid) {
            $this->data['status'] = BookingsStatus::Cancelled;
            $this->repository->update($id, $this->data);
            return [
                'status' => 200,
                'message' => __('Đã huỷ đơn thành công!'),
            ];
        } else {
            switch ($status) {
                case BookingsStatus::Paid:
                    return [
                        'status' => 400,
                        'message' => __('Đã thanh toán không thể huỷ đơn. Vui lòng kiểm tra lại'),
                    ];
                    break;
                case BookingsStatus::Fishing:
                    return [
                        'status' => 400,
                        'message' => __('Đang câu không thể huỷ đơn. Vui lòng kiểm tra lại'),
                    ];
                case BookingsStatus::Completed:
                    return [
                        'status' => 400,
                        'message' => __('Đã hoàn thành câu không thể huỷ. Vui lòng kiểm tra lại'),
                    ];
                    break;
                default:
                    return [
                        'status' => 400,
                        'message' => __('Đã huỷ câu. Vui lòng kiểm tra lại'),
                    ];
                    break;
            }
        }
    }

    public function payment(Request $request)
    {
        $this->data = $request->validated();
        $this->data['user_id'] = $request->user()->id;

        $booking = $this->repository->find($this->data['id']);

        $this->data['lakeChild_id'] = $booking->lakeChild_id;
        $this->data['fishingset_id'] = $booking->fishingset_id;
        $this->data['total_price'] = $this->repository->calculateTotalPrice($this->data);

        $balance = $booking->user->balance;

        if ($booking->status == BookingsStatus::Unpaid) {
            if ($balance->total_balance >= $this->data['total_price']) {
                $this->data['status'] = BookingsStatus::Paid;

                $updateResult = $this->repository->update($this->data['id'], $this->data);

                $amountPaid = $balance->total_balance - $this->data['total_price'];
                return [
                    'status' => 200,
                    'message' => __('Thanh toán thành công.'),
                    'content' => 'Số dư hiện tại ' . number_format($amountPaid, 0, ',', '.') . ' VNĐ'
                ];
            } else {
                $this->notificationRepository->create([
                    'title' => 'Thanh toán đơn đặt câu thất bại',
                    'content' => 'Không đủ số dư. Số dư hiện tại ' . number_format($balance->total_balance, 0, ',', '.') . ' VNĐ',
                    'user_id' => $booking->user_id,
                    'status' => NotificationStatus::Not_Seen
                ]);

                return [
                    'status' => 401,
                    'message' => __('Thanh toán thất bại. Không đủ số dư.'),
                    'content' => 'Số dư hiện tại ' . number_format($balance->total_balance, 0, ',', '.') . ' VNĐ'
                ];
            }
        }

        return [
            'status' => 201,
            'message' => __('Đã thanh toán đơn hàng này. Vui lòng không thanh toán nữa!'),
            'content' => 'Số dư hiện tại ' . number_format($balance->total_balance, 0, ',', '.') . ' VNĐ'
        ];
    }
}
