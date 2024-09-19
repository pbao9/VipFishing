<?php

namespace App\Api\V1\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Auth\{RegisterRequest, LoginRequest, UpdateAvatarRequest, UpdateRequest, UpdatePasswordRequest};
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\Auth\AuthServiceInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Traits\JwtService;
use App\Traits\UseLog;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use App\Api\V1\Http\Resources\Auth\AuthResource;
use App\Api\V1\Support\Response;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * @group Cần thủ
 */
class AuthController extends Controller
{

    use JwtService, Response, AuthServiceApi, UseLog;
    //
    private static string $GUARD_API = 'api';
    private $login;
    protected $auth;
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        AuthServiceInterface $service
    ) {
        $this->userRepository = $userRepository;
        $this->service = $service;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
     * Lấy thông tin Cần thủ
     *
     *
     * Lấy Cần thủ hiện tại thông qua access_token. Trong đó có:
     * <ul>
     *  <li><strong>Giới tính (gender)</strong>:
     *      <ul>
     *          <li>1: Nam (Value mặc định)</li>
     *          <li>2: Nữ</li>
     *          <li>3: Khác</li>
     *      </ul>
     *  </li>
     *
     *  <li><strong>Trạng thái nhận hoa hồng(ref_status)</strong>:
     *      <ul>
     *          <li>0: không</li>
     *          <li>1: Có</li>
     *      </ul>
     *  </li>
     *
     *  <li><strong>Hoạt động(status)</strong>:
     *      <ul>
     *          <li>0: không</li>
     *          <li>1: Có</li>
     *      </ul>
     *  </li>
     * <li><strong>Xếp loại (rank_id)</strong>:
     *       <ul>
     *           <li>1: Cần Thủ Thường</li>
     *           <li>2: Chuẩn Cần Thủ</li>
     *           <li>3: Đài Sư Cấp 3</li>
     *           <li>4: Đài Sư Cấp 2</li>
     *           <li>5: Đài Sư Cấp 1</li>
     *           <li>6: Đặc Cấp Đài Sư</li>
     *       </ul>
     *   </li>
     * </ul>
     * <span>Trong đó các <b>Cần thủ</b> có mức xếp loại = 6, mới được tạo sự kiện!</span>
     * <span><b>total_balance</b>: Tổng số dư của cần thủ</span>
     *
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     *
     * @response 200 {
     * "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "code": "U440581721182288",
     *          "fullname": "Nguyen Van A",
     *          "nickname": "Cần thủ đỉnh cao",
     *          "phone": "0999999999",
     *          "email": "example@gmail.com",
     *          "address": null,
     *          "gender": 1,
     *          "avatar": "/public/assets/images/avatar-user.png",
     *          "status": 1,
     *          "rank_id": null,
     *          "bank_id": null,
     *          "bank_number": null,
     *          "ref_status": 0,
     *          "discount_user": 0,
     *          "total_balance": 0,
     *          "created_at": "2024-07-17T02:11:28.000000Z"
     *      }
     * }
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $user = $request->user()->load(['userscores', 'refer']);
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => new AuthResource($user)
        ]);
    }

    /**
     * Đăng ký
     *
     * Tạo mới 1 cần thủ.
     *
     * @bodyParam fullname string required Họ và tên của bạn. Example: Nguyen Van A
     * @bodyParam nickname string required Biệt danh của bạn. Example: Cần thủ đỉnh cao
     * @bodyParam phone string required Số điện thoại của bạn(Đúng định dạng số điện thoại). Example: 0999999999
     * @bodyParam email string required Email Của bạn. Example: example@gmail.com
     * @bodyParam address string Địa chỉ của bạn. Example: 123 Quang Trung, Gò Vấp, HCM
     * @bodyParam bank_id integer ID Ngân hàng. Example: 2
     * @bodyParam bank_number string Số tài khoản Ngân hàng. Example: 1020000000
     * @bodyParam user_ref string Mã giới thiệu. Example: UFEF921725679928
     * @bodyParam password string required Mật khẩu của bạn. Example: 123456
     * @bodyParam password_confirmation string required Nhập lại mật khẩu của bạn. Example: 123456
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công."
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param \App\Api\V1\Http\Requests\Auth\RegisterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $instance = $this->service->store($request);
        if ($instance) {
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.')
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Thực hiện không thành công.')
        ], 400);
    }

    /**
     * Đăng nhập
     *
     * Đăng nhập tài khoản.
     *
     * @bodyParam phone string required Số điện thoại đăng ký. Example: 0999999999
     * @bodyParam password string required Mật khẩu của bạn. Example: 123456
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Đăng nhập thành công.",
     *      "access_token": "1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K"
     * }
     * @response 401 {
     *      "status": 401,
     *      "message": "Tài khoản hoặc mật khẩu không đúng."
     * }
     *
     * @param \App\Api\V1\Http\Requests\Auth\LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        Log::info('Request', ['phone' => $request->phone, 'password' => $request->password]);
        try {
            return $this->loginUser($request);
        } catch (Exception $e) {
            $this->logError("Login failed", $e);
            return $this->jsonResponseError($e->getMessage());
        }
    }

    /**
     * Cập nhật Cần thủ
     *
     * Cập nhật thông tin cần thủ dựa trên access_token hiện tại. Trong đó có:
     * <ul>
     *  <li><strong>Giới tính (gender)</strong>:
     *      <ul>
     *          <li>1: Nam (Value mặc định)</li>
     *          <li>2: Nữ</li>
     *          <li>3: Khác</li>
     *      </ul>
     *  </li>
     *
     *  <li><strong>Trạng thái nhận hoa hồng(ref_status)</strong>:
     *      <ul>
     *          <li>0: không</li>
     *          <li>1: Có</li>
     *      </ul>
     *  </li>
     *
     *  <li><strong>Hoạt động(status)</strong>:
     *      <ul>
     *          <li>0: không</li>
     *          <li>1: Có</li>
     *      </ul>
     *  </li>
     * <li><strong>Xếp loại (rank_id)</strong>:
     *       <ul>
     *           <li>1: Cần Thủ Thường</li>
     *           <li>2: Chuẩn Cần Thủ</li>
     *           <li>3: Đài Sư Cấp 3</li>
     *           <li>4: Đài Sư Cấp 2</li>
     *           <li>5: Đài Sư Cấp 1</li>
     *           <li>6: Đặc Cấp Đài Sư</li>
     *       </ul>
     *   </li>
     * </ul>
     * <span>Trong đó các <b>Cần thủ</b> có mức xếp loại = 6, mới được tạo sự kiện!</span>
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam fullname string required Họ và tên của bạn. Example: Nguyen Van A
     * @bodyParam email string required Email Của bạn. Example: example@gmail.com
     * @bodyParam gender integer required Giới tính Của bạn. Example: 1
     * @bodyParam address string Địa chỉ hiện tại của bạn. Example: Phạm Văn Đồng, HCM
     * @bodyParam rank_id integer Xếp hạng. Example: 1
     * @bodyParam bank_id integer Ngân hàng. Example: 1
     * @bodyParam bank_number string Số tài khoản. Example: 1138479184892
     * @bodyParam discount_user integer Ưu đãi cần thủ (%). Example: 0
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "code": "U440581721182288",
     *          "username": "0999999999",
     *          "fullname": "Nguyen Van A",
     *          "phone": "0999999999",
     *          "email": "example@gmail.com",
     *          "address": null,
     *          "gender": 1,
     *          "roles": 1,
     *          "vip": 1,
     *          "avatar": "https://server43.mevivu.com/topzone_cms/public/assets/images/avatar-user.png",
     *          "status": 1,
     *          "rank_id": null,
     *          "bank_id": null,
     *          "bank_number": null,
     *          "ref_status": 0,
     *          "discount_user": 0,
     *          "created_at": "2024-07-17T02:11:28.000000Z"
     *      }
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại"
     * }
     *
     * @param \App\Api\V1\Http\Requests\Auth\UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        try {
            $user = $this->service->update($request);
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => new AuthResource($user)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Thực hiện thất bại.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Cập nhật mật khẩu
     *
     * Cập nhật mật khẩu user hiện tại.
     *
     * @bodyParam old_password string required Mật khẩu cũ của bạn. Example: 123
     * @bodyParam password string required Mật khẩu của bạn. Example: 123456
     * @bodyParam password_confirmation string required Nhập lại mật khẩu của bạn. Example: 123456
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @response {
     *      "status": 200,
     *      "message": "Thực hiện thành công."
     * }
     *
     * @param \App\Api\V1\Http\Requests\Auth\UpdatePasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $password = bcrypt($request->input('password'));
        $user = $request->user();
        $user->update([
            'password' => $password
        ]);
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
        ], 200);
    }
}
