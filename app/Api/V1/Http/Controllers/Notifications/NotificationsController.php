<?php

namespace App\Api\V1\Http\Controllers\Notifications;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Notifications\NotificationsRequest;
use App\Api\V1\Http\Resources\Notifications\{AllNotificationsResource, ShowNotificationsResource};
use App\Api\V1\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Api\V1\Services\Notifications\NotificationsServiceInterface;
use App\Api\V1\Services\Notifications\NotificationsService;

/**
 * @group Thông báo
 */

class NotificationsController extends Controller
{
    public function __construct(
        NotificationsRepositoryInterface $repository,
        NotificationsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Danh sách Thông Báo
     *
     * Lấy danh sách Thông báo.
     * Thông tin về một thông báo cụ thể
     *
     *  - ID của thông báo
     *  - Tiêu đề của thông báo
     *  - Nội dung của thông báo
     *  - Trạng thái thông báo
     *   + Đã đọc
     *   + Chưa đọc
     *  - Mã người dùng liên quan
     *  - Mã quản lý liên quan
     *
     * @authenticated Authorization string required
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "title": "Thông tin của Title",
     *               "content": "Thông tin của Content",
     *               "status": "Thông tin của Status",
     *               "user_id": "Thông tin của User_id",
     *               "admin_id": "Thông tin của Admin_id"
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(NotificationsRequest $request)
    {
        try {
            $data = $request->validated();
            $notificationss = $this->repository->getAll();
            $notificationss = new AllNotificationsResource($notificationss);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $notificationss
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
     * Chi tiết Thông Báo
     *
     * Lấy chi tiết Thông báo
     *
     * Thông tin về một thông báo cụ thể
     *
     *  - ID của thông báo
     *  - Tiêu đề của thông báo
     *  - Nội dung của thông báo
     *  - Trạng thái thông báo
     *   + Đã đọc
     *   + Chưa đọc
     *  - Mã người dùng liên quan
     *  - Mã quản lý liên quan
     *
     * @authenticated Authorization string required
     *
     * @pathParam id integer required
     * ID thông báo Example: 1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "title": "Thông tin của Title",
     *               "content": "Thông tin của Content",
     *               "status": "Thông tin của Status",
     *               "user_id": "Thông tin của User_id",
     *               "admin_id": "Thông tin của Admin_id"
     *         }
     *      ]
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
            $notifications = $this->repository->findByID($id);
            $notifications = new ShowNotificationsResource($notifications);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $notifications
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
    //  * Xóa Thông báo
    //  *
    //  * Xóa Thông báo một Thông báo theo ID
    //  *
    //  * Thông tin về một thông báo cụ thể
    //  *
    //  *  - ID của thông báo
    //  *  - Tiêu đề của thông báo
    //  *  - Nội dung của thông báo
    //  *  - Trạng thái thông báo
    //  *   + Đã đọc
    //  *   + Chưa đọc
    //  *  - Mã người dùng liên quan
    //  *  - Mã quản lý liên quan
    //  * 
    //  * @authenticated Authorization string required
    //  * 
    //  * @queryParam id integer required
    //  * id Thông báo. Example: 1
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
    // public function delete(NotificationsRequest $request)
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
    //  * Thêm Thông báo
    //  *
    //  * Thêm một Thông báo mới
    //  *
    //  * Thông tin về một thông báo cụ thể
    //  *
    //  *  - ID của thông báo
    //  *  - Tiêu đề của thông báo
    //  *  - Nội dung của thông báo
    //  *  - Trạng thái thông báo
    //  *   + Đã đọc
    //  *   + Chưa đọc
    //  *  - Mã người dùng liên quan
    //  *  - Mã quản lý liên quan
    //  *
    //  * @authenticated Authorization string required
    //  *
    //  * @bodyParam title string
    //  * Tiêu đề
    //  * @bodyParam content string
    //  * Nội dung
    //  * @bodyParam status integer
    //  * Trạng thái
    //  * @bodyParam user_id integer
    //  * Mã người dùng
    //  * @bodyParam admin_id integer
    //  * Mã quản lý
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
    // public function add(NotificationsRequest $request)
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
    //  * Sửa Thông báo
    //  *
    //  * Sửa một Thông báo
    //  *
    //  * Thông tin về một thông báo cụ thể
    //  *
    //  *  - ID của thông báo
    //  *  - Tiêu đề của thông báo
    //  *  - Nội dung của thông báo
    //  *  - Trạng thái thông báo
    //  *   + Đã đọc
    //  *   + Chưa đọc
    //  *  - Mã người dùng liên quan
    //  *  - Mã quản lý liên quan
    //  * 
    //  * @authenticated Authorization string required
    //  * 
    //  * @bodyParam id integer required 
    //  * ID của thông báo Example: 1
    //  * @bodyParam title string 
    //  * Tiêu đề Example: Nạp tiền
    //  * @bodyParam content string 
    //  * Nội dung Example: Bạn đã nạp 20k vào ví
    //  * @bodyParam status integer 
    //  * Trạng thái Example: 2
    //  * @bodyParam user_id integer 
    //  * Mã người dùng Example: 1
    //  * @bodyParam admin_id integer 
    //  * Mã quản lý Example: 1
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
    // public function edit(NotificationsRequest $request)
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
