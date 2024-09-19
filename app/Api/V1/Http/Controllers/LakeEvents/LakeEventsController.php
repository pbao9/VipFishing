<?php

namespace App\Api\V1\Http\Controllers\LakeEvents;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\LakeEvents\LakeEventsRequest;
use App\Api\V1\Http\Resources\LakeEvents\{AllLakeEventsResource, ShowLakeEventsResource};
use App\Api\V1\Repositories\LakeEvents\LakeEventsRepositoryInterface;
use App\Api\V1\Services\LakeEvents\LakeEventsServiceInterface;
use App\Api\V1\Services\LakeEvents\LakeEventsService;

/**
 * @group Sự kiện
 */

class LakeEventsController extends Controller
{
    // public function __construct(
    //     LakeEventsRepositoryInterface $repository,
    //     LakeEventsServiceInterface $service
    // ) {
    //     $this->repository = $repository;
    //     $this->service = $service;
    // }
    // /**
    //  * DS QL LƯU TRỮ SỰ KIỆN
    //  *
    //  * Lấy danh sách LakeEvents.
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  * 
    //  * @queryParam page integer
    //  * Trang hiện tại, page > 0. Ví dụ: 1
    //  * 
    //  * @queryParam limit integer
    //  * Số lượng LakeEvents trong 1 trang, limit > 0. Ví dụ: 1
    //  * 
    //  * 
    //  * @response 200 {
    //  *      "status": 200,
    //  *      "message": "Thực hiện thành công.",
    //  *      "data": [
    //  *         {
    //  *               "id": 4,
    //  *               "event_id": "Thông tin của Event_id",
    //  *               "lakeChild_id": "Thông tin của LakeChild_id"
    //  *         }
    //  *      ]
    //  * }
    //  * @response 400 {
    //  *      "status": 400,
    //  *      "message": "Vui lòng kiểm tra lại các trường field"
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
    // public function index(LakeEventsRequest $request)
    // {
    //     try {
    //         $data = $request->validated();
    //         $lakeEventss = $this->repository->paginate(...$data);
    //         $lakeEventss = new AllLakeEventsResource($lakeEventss);
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thực hiện thành công.'),
    //             'data' => $lakeEventss
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
    //  * Chi tiết QL LƯU TRỮ SỰ KIỆN
    //  *
    //  * Lấy chi tiết LakeEvents
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
    //  *               "lakeChild_id": "Thông tin của LakeChild_id"
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
    //         $lakeEvents = $this->repository->findByID($id);
    //         $lakeEvents = new ShowLakeEventsResource($lakeEvents);
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thực hiện thành công.'),
    //             'data' => $lakeEvents
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
    //  * Xóa LakeEvents
    //  *
    //  * Xóa LakeEvents một LakeEvents theo ID
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  * 
    //  * @pathParam id integer required
    //  * id LakeEvents. Ví dụ: 1
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
    // public function delete(LakeEventsRequest $request)
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
    //  * Thêm LakeEvents
    //  *
    //  * Thêm một LakeEvents mới
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  * 
    //  * @pathParam event_id INT(11) 
    //  * Mã sự kiện
    //  * @pathParam lakeChild_id INT(11) 
    //  * Mã hồ lẻ
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
    // public function add(LakeEventsRequest $request)
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
    //  * Sửa LakeEvents
    //  *
    //  * Sửa một LakeEvents
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  * 
    //  * 
    //  * @pathParam event_id INT(11) 
    //  * Mã sự kiện
    //  * @pathParam lakeChild_id INT(11) 
    //  * Mã hồ lẻ
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
    // public function edit(LakeEventsRequest $request)
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