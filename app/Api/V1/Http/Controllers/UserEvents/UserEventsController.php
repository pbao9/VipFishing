<?php

namespace App\Api\V1\Http\Controllers\UserEvents;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\UserEvents\UserEventsRequest;
use App\Api\V1\Http\Resources\UserEvents\{AllUserEventsResource, ShowUserEventsResource};
use App\Api\V1\Repositories\UserEvents\UserEventsRepositoryInterface;
use App\Api\V1\Services\UserEvents\UserEventsServiceInterface;

/**
 * @group Sự kiện
 */

class UserEventsController extends Controller
{
    public function __construct(
        UserEventsRepositoryInterface $repository,
        UserEventsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách sự kiện đã tham gia
     *
     * API này cho phép lấy danh sách sự kiện đã tham gia của 1 user đã đăng nhập.
     *
     * Trong đó có:
     * - user_id: Người dùng tham gia
     * - event_id: Sự kiện
     * - has_reward: Có quà?
     *  - `0`: Không có quà
     *  - `1`: Nhận quà
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @queryParam page integer
     * Trang hiện tại, page > 0. Example: 1
     *
     * @queryParam limit integer
     * Số lượng UserEvents trong 1 trang, limit > 0. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 1,
     *               "event_id": 1,
     *               "user_id": 1,
     *               "has_reward": 1
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
    public function index(UserEventsRequest $request)
    {
        try {
            $data = $request->validated();
            $userEventss = $this->repository->paginate(...$data);
            $userEventss = new AllUserEventsResource($userEventss);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $userEventss
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
     * Người dùng tham gia sự kiện
     *
     * Người dùng (user) đã đăng nhập tham gia sự kiện
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam event_id integer
     * Mã sự kiện. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Tham gia thành công."
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
    public function joinEvent(UserEventsRequest $request)
    {
        $response = $this->service->add($request);
        return $response;
    }

    // /**
    //  * Chi tiết QL NHẬN QUÀ
    //  *
    //  * Lấy chi tiết UserEvents
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @pathParam id integer required
    //  * ID
    //  *
    //  *
    //  * @response 200 {
    //  *      "status": 200,
    //  *      "message": "Thực hiện thành công.",
    //  *      "data": [
    //  *         {
    //  *               "id": 4,
    //  *               "event_id": "Thông tin của Event_id",
    //  *               "user_id": "Thông tin của User_id",
    //  *               "has_reward": "Thông tin của Has_reward"
    //  *         }
    //  *      ]
    //  * }
    //  * @response 500 {
    //  *      "status": 500,
    //  *      "message": "Thực hiện thất bại."
    //  * }
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     try {
    //         $userEvents = $this->repository->findByID($id);
    //         $userEvents = new ShowUserEventsResource($userEvents);
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thực hiện thành công.'),
    //             'data' => $userEvents
    //         ]);
    //     } catch (\Exception $e) {
    //         // Xử lý ngoại lệ nếu cần thiết
    //         return response()->json([
    //             'status' => 500,
    //             'message' => __('Thực hiện thất bại.')
    //         ]);
    //     }
    // }



    // /**
    //  * Xóa UserEvents
    //  *
    //  * Xóa UserEvents một UserEvents theo ID
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @pathParam id integer required
    //  * id UserEvents. Ví dụ: 1
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
    //  * @param  \Illuminate\Http\Request  $request
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function delete(UserEventsRequest $request)
    // {

    //     $response = $this->repository->delete($request);

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
    //  * Thêm UserEvents
    //  *
    //  * Thêm một UserEvents mới
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @pathParam event_id INT(11)
    //  * Mã sự kiện
    //  * @pathParam user_id INT(11)
    //  * Mã người dùng
    //  * @pathParam has_reward INT(11)
    //  * Trạng thái nhận quà
    //  *
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
    //  * @param  \Illuminate\Http\Request  $request
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function add(UserEventsRequest $request)
    // {
    //     $response = $this->service->add($request);
    //     if ($response) {
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thêm thành công.')
    //         ]);
    //     }
    //     return response()->json([
    //         'status' => 400,
    //         'message' => __('Thêm thất bại. Hãy kiểm tra lại.')
    //     ], 400);
    // }


    // /**
    //  * Sửa UserEvents
    //  *
    //  * Sửa một UserEvents
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  *
    //  * @pathParam event_id INT(11)
    //  * Mã sự kiện
    //  * @pathParam user_id INT(11)
    //  * Mã người dùng
    //  * @pathParam has_reward INT(11)
    //  * Trạng thái nhận quà
    //  *
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
    //  * @param  \Illuminate\Http\Request  $request
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(UserEventsRequest $request)
    // {
    //     $response = $this->service->edit($request);
    //     if ($response) {
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Sửa thành công.')
    //         ]);
    //     }
    //     return response()->json([
    //         'status' => 400,
    //         'message' => __('Sửa thất bại. Hãy kiểm tra lại.')
    //     ], 400);
    // }
}
