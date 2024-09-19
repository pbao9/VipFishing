<?php

namespace App\Api\V1\Http\Controllers\CommissionHistory;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\CommissionHistory\CommissionHistoryRequest;
use App\Api\V1\Http\Resources\CommissionHistory\{AllCommissionHistoryResource, ShowCommissionHistoryResource};
use App\Api\V1\Repositories\CommissionHistory\CommissionHistoryRepositoryInterface;
use App\Api\V1\Services\CommissionHistory\CommissionHistoryServiceInterface;
use Illuminate\Http\Request;

/**
 * @group Hoa hồng
 */

class CommissionHistoryController extends Controller
{
    public function __construct(
        CommissionHistoryRepositoryInterface $repository,
        CommissionHistoryServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách Tiền hoa hồng của người dùng
     *
     * API này cho phép truy xuất danh sách tất cả tiền hoa hồng của người dùng
     * 
     * Trong đó có:
     * - <strong>amount</strong>: Số tiền hoa hồng
     * - <strong>type</strong>: Hình thức giao dịch (mặc định là `2`)
     *  - `0`: Nạp
     *  - `1`: Rút
     *  - `2`: Tiền hoa hồng
     *  - `3`: Bồi thường
     *  - `4`: Đặt câu
     *  - `5`: Hoàn tiền
     * - <strong>user_id</strong>: Mã người dùng
     * - <strong>booking_id</strong>: Mã đơn đặt câu
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @queryParam page integer
     * Trang hiện tại, page > 0. Example: 1
     *
     * @queryParam limit integer
     * Số lượng Tiền hoa hồng trong 1 trang, limit > 0. Example: 10
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 1,
     *               "amount": 10000,
     *               "type": 2,
     *               "user_id": 1,
     *               "booking_id": 1
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
    public function index(CommissionHistoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $commissionHistorys = $this->repository->paginate(...$data);
            $commissionHistorys = new AllCommissionHistoryResource($commissionHistorys);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $commissionHistorys
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
     * Chi tiết Tiền hoa hồng của người dùng
     *
     * API này cho phép truy xuất một tiền hoa hồng của người dùng theo ID
     * 
     * Trong đó có:
     * - <strong>amount</strong>: Số tiền hoa hồng
     * - <strong>type</strong>: Hình thức giao dịch (mặc định là `2`)
     *  - `0`: Nạp
     *  - `1`: Rút
     *  - `2`: Tiền hoa hồng
     *  - `3`: Bồi thường
     *  - `4`: Đặt câu
     *  - `5`: Hoàn tiền
     * - <strong>user_id</strong>: Mã người dùng
     * - <strong>booking_id</strong>: Mã đơn đặt câu
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * ID Tiền hoa hồng. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "amount": 10000,
     *          "type": 2,
     *          "user_id": 1,
     *          "booking_id": 1
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
    public function show($id, Request $request)
    {
        try {
            $user = $request->user();
            $commission = $user->commissionHistories()->find($id);

            if ($commission) {
                $commission = new ShowCommissionHistoryResource($commission);
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $commission
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => __('Tiền hoa hồng không tìm thấy.')
                ]);
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }



    // /**
    //  * Xóa Tiền hoa hồng
    //  *
    //  * API này cho phép xóa Tiền hoa hồng theo ID
    //  *
    //  * @authenticated Authorization string required
    //  * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @bodyParam id integer required
    //  * ID Tiền hoa hồng. Example: 1
    //  *
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
    // public function delete(CommissionHistoryRequest $request)
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
    //  * Thêm Tiền hoa hồng
    //  *
    //  * API này cho phép thêm một Tiền hoa hồng mới
    //  *
    //  * @authenticated Authorization string required
    //  * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @bodyParam amount integer required Số tiền nhận hoa hồng. Example: 1000
    //  * @bodyParam user_id integer Mã người dùng. Example: 1
    //  * @bodyParam booking_id integer required Mã đơn đặt câu. Example: 1
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
    // public function add(CommissionHistoryRequest $request)
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
    //  * Sửa Tiền hoa hồng
    //  *
    //  * API này cho phép sửa một Tiền hoa hồng
    //  *
    //  * @authenticated Authorization string required
    //  * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @bodyParam id integer required ID Tiền hoa hồng. Example: 1
    //  * @bodyParam amount integer Số tiền nhận hoa hồng. Example: 1000
    //  * @bodyParam user_id integer Mã người dùng. Example: 1
    //  * @bodyParam booking_id integer Mã đơn đặt câu. Example: 1
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
    // public function edit(CommissionHistoryRequest $request)
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
