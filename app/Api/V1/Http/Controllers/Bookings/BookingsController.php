<?php

namespace App\Api\V1\Http\Controllers\Bookings;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Bookings\BookingsRequest;
use App\Api\V1\Http\Resources\Bookings\{AllBookingsResource, ShowBookingsResource};
use App\Api\V1\Repositories\Bookings\BookingsRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\Bookings\BookingsServiceInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;
use App\Traits\JwtService;
use App\Traits\UseLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * @group Đơn đặt câu
 */

class BookingsController extends Controller
{
    use JwtService, Response, AuthServiceApi, UseLog;
    private static string $GUARD_API = 'api';
    private $login;
    protected $auth;
    protected $userRepository;
    public function __construct(
        UserRepositoryInterface $userRepository,
        BookingsRepositoryInterface $repository,
        BookingsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->userRepository = $userRepository;
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
     * Danh sách đơn đặt câu của người dùng
     *
     * API này cho phép truy xuất danh sách các đơn đặt câu của người dùng đăng nhập
     *
     * Trong đó có:
     * - <strong>fishing_date</strong>: Ngày đặt câu
     * - <strong>position</strong>: vị trí câu trong hồ lẻ
     * - <strong>total_price</strong>: tổng giá tiền đơn đặt câu
     * - <strong>status</strong>: Trạng thái
     *  - `0`: Chưa thanh toán
     *  - `1`: Đã thanh toán
     *  - `2`: Đang câu
     *  - `3`: Hoàn thành
     *  - `4`: Đã hủy
     * - <strong>user_id</strong>: Mã người dùng
     * - <strong>lakeChild_id</strong>: Mã hồ lẻ
     * - <strong>fishingset_id</strong>: Mã suất câu
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
     * Số lượng đơn đặt câu trong 1 trang, limit > 0. Example: 10
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 1,
     *               "fishing_date": "2024-07-18 00:00:00",
     *               "position": 10,
     *               "total_price": 100000,
     *               "status": 1,
     *               "user_id": 1,
     *               "lakeChild_id": 1,
     *               "fishingset_id": 1
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
    public function index(BookingsRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $bookings = $this->repository->paginate(...$data);
            $bookings = new AllBookingsResource($bookings);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $bookings
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
     * Chi tiết đơn đặt câu theo người dùng
     *
     * API này cho phép truy xuất một đơn đặt câu của người dùng đăng nhập theo ID
     *
     * Trong đó có:
     * - <strong>fishing_date</strong>: Ngày đặt câu
     * - <strong>position</strong>: Vị trí câu trong hồ lẻ
     * - <strong>total_price</strong>: Tổng giá tiền đơn đặt câu
     * - <strong>booking_code</strong>: Mã booking
     * - <strong>status</strong>: Trạng thái
     *  - `0`: Chưa thanh toán
     *  - `1`: Đã thanh toán
     *  - `2`: Đang câu
     *  - `3`: Hoàn thành
     *  - `4`: Đã hủy
     * - <strong>user_id</strong>: Mã người dùng
     * - <strong>lakeChild_id</strong>: Mã hồ lẻ
     * - <strong>fishingset_id</strong>: Mã suất câu
     *
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * ID Đơn đặt câu. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "fishing_date": "2024-07-18 00:00:00",
     *          "position": 10,
     *          "total_price": 100000,
     *          "status": 1,
     *          "user_id": 1,
     *          "lakeChild_id": 1,
     *          "fishingset_id": 1
     *      }
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
            // $user = $request->user();
            $user = auth()->user();
            $booking = $user->bookings()->find($id);
            if ($booking) {
                $booking = new ShowBookingsResource($booking);
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $booking
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => __('Đơn đặt câu không tìm thấy.')
                ]);
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.' . $e->getMessage())
            ]);
        }
    }


    /**
     * Thêm Đơn đặt câu
     *
     * API này cho phép thêm một đơn đặt câu mới
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam fishing_date string required Ngày câu. Example: 2024-07-18 00:00:00
     * @bodyParam lakeChild_id integer required Mã hồ lẻ. Example: 1
     * @bodyParam fishingset_id integer required Mã suất câu. Example: 1
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
    public function add(BookingsRequest $request)
    {
        try {
            return $this->service->add($request);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Thanh toán booking
     *
     * API này cho giúp người dùng thanh toán booking
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id integer required ID booking. Example: 12
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thanh toán thành công"
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Sửa thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \App\Api\V1\Http\Requests\Bookings\BookingsRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(BookingsRequest $request)
    {
        try {
            if (!auth()->check()) {
                Log::info('User not authenticated');
                return response()->json([
                    'status' => 401,
                    'message' => __('Bạn chưa đăng nhập.'),
                ], 401);
            }
            $user = $request->user();
            $booking = $user->bookings()->find($request->id);
            if ($booking) {
                $response = $this->service->payment($request);

                return response()->json([
                    'status' => $response['status'],
                    'message' => $response['message'],
                    'content' => $response['content'],
                ], $response['status']);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => __('Đơn đặt câu không tìm thấy.')
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Payment error:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Huỷ đơn
     *
     * API này cho phép huỷ đơn đặt câu theo ID
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam id integer required id Đơn đặt câu. Example: 1
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
     * @param  \App\Api\V1\Http\Requests\Bookings\BookingsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(BookingsRequest $request)
    {
        $data = $request->validated();
        // $user = auth()->user();
        $user = $request->user();
        $booking = $user->bookings()->find($data['id']);
        if ($booking) {
            $response = $this->service->delete($data['id']);

            if ($response) {
                return response()->json([
                    'status' => $response['status'],
                    'message' => $response['message'],
                ], $response['status']);
            }
            return response()->json([
                'status' => $response['status'],
                'message' => $response['message'],
            ], $response['status']);
        } else {
            return response()->json([
                'status' => 404,
                'message' => __('Đơn đặt câu không tìm thấy.')
            ]);
        }
    }
}
