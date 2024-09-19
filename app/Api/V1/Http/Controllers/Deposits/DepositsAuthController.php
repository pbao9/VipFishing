<?php

namespace App\Api\V1\Http\Controllers\Deposits;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Deposits\DepositsRequest;
use App\Api\V1\Http\Resources\Deposits\{AllDepositsResource, ShowDepositsResource};
use App\Api\V1\Repositories\Deposits\DepositsRepositoryInterface;
use App\Api\V1\Services\Deposits\DepositsServiceInterface;

/**
 * @group Nạp & Rút
 */

class DepositsAuthController extends Controller
{
    protected $depositController;
    public function __construct(
        DepositsRepositoryInterface $repository,
        DepositsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->depositController = new DepositsController($repository, $service);
    }

    /**
     * Danh sách Nạp của người dùng
     *
     * API này cho phép truy xuất danh sách tất cả nạp của người dùng
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
     * - license: Chứng từ
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
     * Số lượng Deposits trong 1 trang, limit > 0. Example: 10
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
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(DepositsRequest $request)
    {
        return $this->depositController->index($request, auth()->user()->id);
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
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = auth()->user();
            $deposit = $user->deposits()->find($id);

            if ($deposit) {
                return $this->depositController->show($deposit->id);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => __('Nạp không tìm thấy.')
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
     * Thêm Nạp của người dùng
     *
     * API này cho phép thêm một Nạp mới
     *
     * @authenticated Authorization string required 
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @bodyParam amount integer required Số tiền. Example: 100000
     * @bodyParam note string Ghi chú. Example: abc
     * @bodyParam status integer required Trạng thái. Example: 0
     * @bodyParam license string Ảnh chứng từ
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
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function add(DepositsRequest $request)
    {
        $request->merge(['user_id' => auth()->user()->id]);
        return $this->depositController->add($request);
    }


    /**
     * Sửa Nạp của người dùng
     *
     * API này cho phép sửa một Nạp
     *
     * @authenticated Authorization string required 
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @bodyParam id integer required ID Nạp. Example: 1
     * @bodyParam amount integer Số tiền. Example: 100000
     * @bodyParam note string Ghi chú. Example: abc
     * @bodyParam status integer Trạng thái. Example: 0
     * @bodyParam license string Ảnh chứng từ
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Sửa thành công."
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Sửa thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(DepositsRequest $request)
    {
        $user = auth()->user();
        $deposit = $user->deposits()->find($request->id);

        if ($deposit) {
            $request->merge(['user_id' => auth()->user()->id]);
            return $this->depositController->edit($request);
        } else {
            return response()->json([
                'status' => 404,
                'message' => __('Nạp không tìm thấy.')
            ]);
        }
    }

}