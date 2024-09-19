<?php

namespace App\Api\V1\Http\Controllers\Deposits;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Deposits\DepositsRequest;
use App\Api\V1\Http\Resources\Deposits\{AllDepositsResource, ShowDepositsResource};
use App\Api\V1\Repositories\Deposits\DepositsRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\Deposits\DepositsServiceInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;
use App\Traits\JwtService;
use App\Traits\UseLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * @group Nạp & Rút
 */

class DepositsController extends Controller
{

    public function __construct(
        DepositsRepositoryInterface $repository,
        DepositsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách Nạp của người dùng
     *
     * API này cho phép truy xuất danh sách tất cả nạp của người dùng
     *
     * Trong đó có:
     * - code: Mã nạp
     * - user_id: Mã người nạp
     * - amount: Số tiền nạp
     * - note: Ghi chú
     * - status: Trạng thái giao dịch
     *  - `0`: Đang duyệt
     *  - `1`: Hoàn thành
     * - type: Hình thức giao dịch (mặc định là `0`)
     *  - `0`: Nạp
     *  - `1`: Rút
     *  - `2`: Tiền hoa hồng
     *  - `3`: Bồi thường
     *  - `4`: Đặt câu
     *  - `5`: Hoàn tiền
     * - license: Chứng từ
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
     *              "id": 1,
     *              "code": "U205011721014656",
     *              "user_id": 1,
     *              "admin_id": 1,
     *              "amount": 10000,
     *              "note": "abc",
     *              "status": 1,
     *              "license": "",
     *              "type": 0
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
     * @return \Illuminate\Http\Response
     */
    public function index(DepositsRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $deposits = $this->repository->paginate(...$data);
            $deposits = new AllDepositsResource($deposits);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $deposits
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
     * Chi tiết Nạp của người dùng
     *
     * API này cho phép truy xuất một nạp của người dùng theo ID
     *
     * Trong đó có:
     * - code: Mã nạp
     * - user_id: Mã người nạp
     * - admin_id: Mã người duyệt
     * - amount: Số tiền nạp
     * - note: Ghi chú
     * - status: Trạng thái giao dịch
     *  - `0`: Đang duyệt
     *  - `1`: Hoàn thành
     * - type: Hình thức giao dịch (mặc định là `0`)
     *  - `0`: Nạp
     *  - `1`: Rút
     *  - `2`: Tiền hoa hồng
     *  - `3`: Bồi thường
     *  - `4`: Đặt câu
     *  - `5`: Hoàn tiền
     * - license: Chứng từ
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * ID Nạp. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "code": "U205011721014656",
     *          "user_id": 1,
     *          "admin_id": 1,
     *          "amount": 10000,
     *          "note": "abc",
     *          "status": 1,
     *          "license": "",
     *          "type": 0
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
            $deposit = $user->deposits()->find($id);

            if ($deposit) {
                $deposits = new ShowDepositsResource($deposit);
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $deposits
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => __('Lệnh nạp không tìm thấy.')
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



    /**
     * Xóa Nạp
     *
     * API này cho phép xóa một Nạp theo ID
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam id integer required
     * ID Deposits. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Xóa thành công."
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Xóa thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(DepositsRequest $request)
    {

        $response = $this->service->delete($request);

        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => __('Xóa thành công.')
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Xóa thất bại.')
        ]);
    }

    /**
     * Thêm Nạp của người dùng
     *
     * API này cho phép thêm một Nạp mới
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam amount integer required Số tiền. Example: 100000
     * @bodyParam note string Ghi chú. Example: abc
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function add(DepositsRequest $request)
    {
        try {
            $response = $this->service->add($request);
            if ($response) {
                return response()->json([
                    'status' => $response['status'],
                    'message' => $response['message']
                ], $response['status']);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
