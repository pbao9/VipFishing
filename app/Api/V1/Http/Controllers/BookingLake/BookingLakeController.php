<?php

namespace App\Api\V1\Http\Controllers\BookingLake;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\BookingLake\BookingLakeRequest;
use App\Api\V1\Http\Resources\BookingLake\{AllBookingLakeResource, ShowBookingLakeResource};
use App\Api\V1\Repositories\BookingLake\BookingLakeRepositoryInterface;
use App\Api\V1\Services\BookingLake\BookingLakeServiceInterface;

/**
 * @group Giá tiền đơn đặt câu
 */

class BookingLakeController extends Controller
{
    public function __construct(
        BookingLakeRepositoryInterface $repository,
        BookingLakeServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * DS QL Giá tiền đơn đặt câu
     *
     * API này cho phép truy xuất danh sách các giá tiền của đơn đặt câu
     *
     * Trong đó có:
     * - <strong>booking_id</strong>: Mã đơn đặt câu
     * - <strong>variationFishs_id</strong>: Mã biến thể cá
     * - <strong>total_price</strong>: tổng giá tiền đơn đặt câu
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 1,
     *               "booking_id": 1,
     *               "variationFishs_id": 1,
     *               "total_price": 100000
     *         }
     *      ]
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Vui lòng kiểm tra lại các trường field"
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(BookingLakeRequest $request, $user_id = null)
    {
        try {
            $data = $request->validated();
            if ($user_id) {
                $data['user_id'] = $user_id;
            }
            $bookingLakes = $this->repository->getAll();
            $bookingLakes = new AllBookingLakeResource($bookingLakes);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $bookingLakes
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.'),
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Chi tiết QL Giá tiền đơn đặt câu
     *
     * API này cho phép truy xuất một giá tiền của đơn đặt câu theo ID
     *
     * Trong đó có:
     * - <strong>booking_id</strong>: Mã đơn đặt câu
     * - <strong>variationFishs_id</strong>: Mã biến thể cá
     * - <strong>total_price</strong>: tổng giá tiền đơn đặt câu
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * ID Giá tiền đơn đặt câu. Example: 1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "booking_id": 1,
     *          "variationFishs_id": 1,
     *          "total_price": 100000
     *      }
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $bookingLake = $this->repository->findByID($id);
            $bookingLake = new ShowBookingLakeResource($bookingLake);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $bookingLake
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }
}
