<?php

namespace App\Api\V1\Http\Controllers\CloseLakes;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\CloseLakes\CloseLakesRequest;
use App\Api\V1\Http\Resources\CloseLakes\{AllCloseLakesResource, ShowCloseLakesResource};
use App\Api\V1\Repositories\CloseLakes\CloseLakesRepositoryInterface;
use App\Api\V1\Services\CloseLakes\CloseLakesServiceInterface;

/**
 * @group Hồ đóng cửa
 */

class CloseLakesController extends Controller
{
    public function __construct(
        CloseLakesRepositoryInterface $repository,
        CloseLakesServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách Hồ đóng cửa
     *
     * API này cho phép truy xuất danh sách tất cả hồ đóng cửa
     *
     * Trong đó có:
     * - <strong>lakechild_id</strong>: Mã hồ lẻ
     * - <strong>close_date</strong>: Ngày đóng cửa
     * - <strong>open_date</strong>: Ngày mở cửa
     * - <strong>close_days</strong>: Số ngày đóng cửa (min `1`)
     * - <strong>canceled_bookings</strong>: Số đơn đặt câu bị hủy
     * - <strong>total_refund_amount</strong>: Tổng số tiền hoàn trả cho người dùng
     * - <strong>compensation_amount</strong>: Tổng số tiền bồi thường cho người dùng
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
     *               "lakechild_id": 1,
     *               "close_date": "2024-07-18 00:00:00",
     *               "open_date": "2024-07-20 00:00:00",
     *               "close_days": 2,
     *               "canceled_bookings": 10,
     *               "total_refund_amount": 1000000,
     *               "compensation_amount": 100000
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
    public function index(CloseLakesRequest $request)
    {
        try {
            $data = $request->validated();
            $closeLakess = $this->repository->getAll();
            $closeLakess = new AllCloseLakesResource($closeLakess);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $closeLakess
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }

    /**
     * Chi tiết Hồ đóng cửa
     *
     * API này cho phép truy xuất một hồ đóng cửa theo ID
     *
     * Trong đó có:
     * - <strong>lakechild_id</strong>: Mã hồ lẻ
     * - <strong>close_date</strong>: Ngày đóng cửa
     * - <strong>open_date</strong>: Ngày mở cửa
     * - <strong>close_days</strong>: Số ngày đóng cửa (min `1`)
     * - <strong>canceled_bookings</strong>: Số đơn đặt câu bị hủy
     * - <strong>total_refund_amount</strong>: Tổng số tiền hoàn trả cho người dùng
     * - <strong>compensation_amount</strong>: Tổng số tiền bồi thường cho người dùng
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @pathParam id integer required
     * ID Hồ đóng cửa. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "lakechild_id": 1,
     *          "close_date": "2024-07-18 00:00:00",
     *          "open_date": "2024-07-20 00:00:00",
     *          "close_days": 2,
     *          "canceled_bookings": 10,
     *          "total_refund_amount": 1000000,
     *          "compensation_amount": 100000
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
            $closeLakes = $this->repository->findByID($id);
            $closeLakes = new ShowCloseLakesResource($closeLakes);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $closeLakes
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }



    // /**
    //  * Xóa Hồ đóng cửa
    //  *
    //  * API này cho phép xóa một hồ đóng cửa theo ID
    //  *
    //  * @authenticated Authorization string required
    //  * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @bodyParam id integer required
    //  * ID hồ đóng cửa. Example: 1
    //  *
    //  * @response 200 {
    //  *      "status": 200,
    //  *      "message": "Xóa thành công."
    //  * }
    //  * @response 400 {
    //  *      "status": 400,
    //  *      "message": "Xóa thất bại."
    //  * }
    //  *
    //  * @param  \Illuminate\Http\Request $request
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function delete(CloseLakesRequest $request)
    // {

    //     $response = $this->service->delete($request);

    //     if ($response) {
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Xóa thành công.')
    //         ]);
    //     }
    //     return response()->json([
    //         'status' => 400,
    //         'message' => __('Xóa thất bại.')
    //     ]);
    // }

    // /**
    //  * Thêm Hồ đóng cửa
    //  *
    //  * API này cho phép thêm một hồ đóng cửa mới
    //  *
    //  * @authenticated Authorization string required
    //  * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @bodyParam lakechild_id integer required Mã hồ lẻ. Example: 1
    //  * @bodyParam close_date string required Ngày đóng cửa. Example: 2024-07-18 00:00:00
    //  * @bodyParam close_days integer required Số ngày đóng cửa. close_days > 1. Example: 1
    //  *
    //  * @response 200 {
    //  *      "status": 200,
    //  *      "message": "Thêm thành công."
    //  * }
    //  * @response 400 {
    //  *      "status": 400,
    //  *      "message": "Thêm thất bại. Hãy kiểm tra lại."
    //  * }
    //  *
    //  * @param  \Illuminate\Http\Request $request
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function add(CloseLakesRequest $request)
    // {
    //     try {
    //         $response = $this->service->add($request);
    //         if ($response) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => __('Thêm thành công.')
    //             ]);
    //         }
    //         return response()->json([
    //             'status' => 400,
    //             'message' => __('Thêm thất bại. Hãy kiểm tra lại.'),
    //         ], 400);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => $e->getMessage(),
    //         ], 400);
    //     }
    // }


    // /**
    //  * Sửa Hồ đóng cửa
    //  *
    //  * API này cho phép sửa một hồ đóng cửa
    //  *
    //  * @authenticated Authorization string required
    //  * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @bodyParam id integer required Mã Hồ đóng cửa. Example: 1
    //  * @bodyParam lakechild_id integer Mã hồ lẻ. Example: 1
    //  * @bodyParam close_date string Ngày đóng cửa. Example: 2024-07-18 00:00:00
    //  * @bodyParam close_days integer Số ngày đóng cửa. Example: 1
    //  *
    //  * @response 200 {
    //  *      "status": 200,
    //  *      "message": "Sửa thành công."
    //  * }
    //  * @response 400 {
    //  *      "status": 400,
    //  *      "message": "Sửa thất bại. Hãy kiểm tra lại."
    //  * }
    //  *
    //  * @param  \Illuminate\Http\Request $request
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(CloseLakesRequest $request)
    // {
    //     try {
    //         $response = $this->service->edit($request);
    //         if ($response) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => __('Sửa thành công.')
    //             ]);
    //         }
    //         return response()->json([
    //             'status' => 400,
    //             'message' => __('Sửa thất bại. Hãy kiểm tra lại.')
    //         ], 400);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => $e->getMessage(),
    //         ], 400);
    //     }
    // }

}
