<?php

namespace App\Api\V1\Http\Controllers\Balances;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Balances\BalancesRequest;
use App\Api\V1\Http\Resources\Balances\{AllBalancesResource, ShowBalancesResource};
use App\Api\V1\Repositories\Balances\BalancesRepositoryInterface;
use App\Api\V1\Services\Balances\BalancesServiceInterface;
use Illuminate\Http\Request;

/**
 * @group Cần thủ
 */

class BalancesController extends Controller
{
    public function __construct(
        BalancesRepositoryInterface $repository,
        BalancesServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách số dư cần thủ
     *
     * API này cho phép truy xuất danh sách các số dư của người dùng
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
     *          {
     *              "id": 1,
     *              "user_id": 1,
     *              "total_balance": 0
     *          }
     *      ]
     * }
     *
     * @response 400 {
     *      "status": 400,
     *      "message": "Không tìm thấy."
     * }
     *
     * @response 403 {
     *      "status": 403,
     *      "message": "Không có quyền truy cập."
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Unable to fetch trip_detail..."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(BalancesRequest $request)
    {
        try {
            $balances = $this->repository->getAll();
            $balances = new AllBalancesResource($balances);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $balances
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }


    /**
     * Chi tiết Số dư theo user
     *
     * API này cho phép truy xuất số dư của một người dùng dựa theo người dùng đã đăng nhập
     *
     * Trong đó có:
     * - <strong>user_id</strong>: mã người dùng
     * - <strong>total_balance</strong>: tổng số dư của người dùng
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam user_id integer required
     * Mã người dùng - user_id. Example: 1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *               "id": 1,
     *               "user_id": 1,
     *               "total_balance": 0
     *         }
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        try {
            $balances = $this->repository->findByID($request->user()->balance->id);
            $balances = new ShowBalancesResource($balances);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $balances
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
