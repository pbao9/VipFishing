<?php

namespace App\Api\V1\Http\Controllers\Withdraws;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Withdraws\WithdrawsRequest;
use App\Api\V1\Http\Resources\Withdraws\{AllWithdrawsResource, ShowWithdrawsResource};
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Repositories\Withdraws\WithdrawsRepositoryInterface;
use App\Api\V1\Services\Withdraws\WithdrawsServiceInterface;
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

class WithdrawsController extends Controller
{
    use JwtService, Response, AuthServiceApi, UseLog;
    private static string $GUARD_API = 'api';
    private $login;
    protected $auth;
    protected $userRepository;
    public function __construct(
        UserRepositoryInterface $userRepository,
        WithdrawsRepositoryInterface $repository,
        WithdrawsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->service = $service;
        $this->middleware('auth:api');
    }

    protected function resolve()
    {


        if (empty($this->login['phone']) || empty($this->login['password'])) {
            Log::error('Phone or password is missing in login data.');
            return false;
        }

        $user = $this->userRepository->findByField('phone', $this->login['phone']);

        Log::info('User found:', ['user' => $user]);

        if ($user && Hash::check($this->login['password'], $user->password)) {
            Auth::login($user);
            return true;
        }

        return false;
    }

    /**
     * Danh sách Rút của người dùng
     *
     * API này cho phép truy xuất danh sách tất cả rút của người dùng
     * 
     * Trong đó có:
     * - code: Mã rút
     * - user_id: Mã người rút
     * - admin_id: Mã người duyệt
     * - amount: Số tiền rút
     * - note: Ghi chú
     * - status: Trạng thái giao dịch
     *  - `0`: Đang duyệt
     *  - `1`: Hoàn thành
     * - type: Hình thức giao dịch (mặc định là `1`)
     *  - `0`: Nạp
     *  - `1`: Rút
     *  - `2`: Tiền hoa hồng
     *  - `3`: Bồi thường
     *  - `4`: Đặt câu
     *  - `5`: Hoàn tiền
     * - other_bank: Ngân hãng khác
     *  - `0`: Không
     *  - `1`: Có
     * - bank_id: Mã ngân hãng
     * - bank_number: Số tài khoản
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
     *              "amount": 100000,
     *              "note": "abc",
     *              "status": 1,
     *              "other_bank": 0,
     *              "bank_id": 1,
     *              "bank_number": "18070497210",
     *              "license": "",
     *              "type": "1"
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
    public function index(WithdrawsRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $withdraws = $this->repository->paginate(...$data);
            $withdraws = new AllWithdrawsResource($withdraws);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $withdraws
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
     * Chi tiết Rút của người dùng
     *
     * API này cho phép truy xuất một rút của người dùng theo ID
     * 
     * Trong đó có:
     * - code: Mã rút
     * - user_id: Mã người rút
     * - admin_id: Mã người duyệt
     * - amount: Số tiền rút
     * - note: Ghi chú
     * - status: Trạng thái giao dịch
     *  - `0`: Đang duyệt
     *  - `1`: Hoàn thành
     * - type: Hình thức giao dịch (mặc định là `1`)
     *  - `0`: Nạp
     *  - `1`: Rút
     *  - `2`: Tiền hoa hồng
     *  - `3`: Bồi thường
     *  - `4`: Đặt câu
     *  - `5`: Hoàn tiền
     * - other_bank: Ngân hãng khác
     *  - `0`: Không
     *  - `1`: Có
     * - bank_id: Mã ngân hãng
     * - bank_number: Số tài khoản
     * - license: Chứng từ
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * ID Rút. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *              "id": 1,
     *              "code": "U205011721014656",
     *              "user_id": 1,
     *              "admin_id": 1,
     *              "amount": 100000,
     *              "note": "abc",
     *              "status": 1,
     *              "other_bank": 0,
     *              "bank_id": 1,
     *              "bank_number": "18070497210",
     *              "license": "",
     *              "type": "1"
     *         }
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
    public function show($id, Request $request)
    {
        try {
            $user = $request->user();
            $withdraw = $user->withdraws()->find($id);

            if ($withdraw) {
                $withdraw = new ShowWithdrawsResource($withdraw);
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $withdraw
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => __('Lệnh rút không tìm thấy.')
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
     * Xóa Rút
     *
     * API này cho phép xóa một Rút theo ID
     *
     * @authenticated Authorization string required 
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     * 
     * @bodyParam id integer required
     * ID rút. Example: 1
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
    public function delete(WithdrawsRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        $withdraw = $user->withdraws()->find($data['id']);

        if ($withdraw) {
            $response = $this->service->delete($data['id']);

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
        } else {
            return response()->json([
                'status' => 404,
                'message' => __('Lệnh rút không tìm thấy.')
            ]);
        }
    }

    /**
     * Thêm Rút của người dùng
     *
     * API này cho phép thêm một Rút mới của người dùng
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam amount integer required Số tiền rút. Example: 1
     * @bodyParam note string Ghi chú. Example: abc
     * @bodyParam other_bank integer Ngân hàng khác. Example: 1
     * @bodyParam bank_id integer Mã ngân hàng. Example: 1
     * @bodyParam bank_number string Số tài khoản. Example: 1138479184892
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(WithdrawsRequest $request)
    {
        try {
            $response = $this->service->add($request);
            if ($response) {
                return response()->json([
                    'status' => $response['status'],
                    'message' => $response['message'],
                ], $response['status']);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi xử lý yêu cầu rút tiền', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
