<?php

namespace App\Api\V1\Http\Controllers\Events;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Events\EventsRequest;
use App\Api\V1\Http\Resources\Events\{AllEventsResource, ShowEventsResource};
use App\Api\V1\Repositories\Events\EventsRepositoryInterface;
use App\Api\V1\Services\Events\EventsServiceInterface;

/**
 * @group Sự kiện
 */

class EventsController extends Controller
{
    public function __construct(
        EventsRepositoryInterface $repository,
        EventsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách tất cả sự kiện
     *
     * API này cho phép lấy danh sách sự kiện.
     *
     * Trong đó có:
     * - title: Tên sự kiện
     * - code: Mã sự kiện
     * - picture: Ảnh sự kiện
     * - reward: Phần quà
     * - reward_value: Giá trị mỗi phần quà
     * - reward_quantity: Số lượng phần quà còn lại
     * - start_date: Ngày bắt đầu sự kiện
     * - end_date: Ngày kết thúc sự kiện
     * - status: Trạng thái sự kiện
     *  - `0`: Finished - kết thúc
     *  - `1`: Active - Hoạt động
     * - events_condition: Có điều kiện tham gia hay không (có: `1` hoặc không: `0`)
     *  - Nếu `1`:
     *      - ccv_point: Điểm CCV
     *      - rank_id: Mức xếp hạng yêu cầu
     * - lakechild_id: Hồ câu tổ chức sự kiện
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
     *              "title": "Sự kiện A",
     *              "picture": "https//core.mevivu.com/hinhanh.jpg",
     *              "reward": "ABC",
     *              "reward_value": 200000,
     *              "reward_quantity": 20,
     *              "start_date": "2024-07-18 00:00:00",
     *              "end_date": "2024-07-28 00:00:00",
     *              "status": 1,
     *              "events_condition": 1,
     *              "ccv_point": 20,
     *              "rank_id": 1,
     *              "user_id": 1,
     *              "lakechild_id": 1
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
    public function index(EventsRequest $request)
    {
        try {
            $data = $request->validated();
            $eventss = $this->repository->getAll();
            $eventss = new AllEventsResource($eventss);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $eventss
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
     * Chi tiết sự kiện
     *
     * API này cho phép lấy chi tiết thông tin sự kiện
     *
     * Trong đó có:
     * - title: Tên sự kiện
     * - code: Mã sự kiện
     * - picture: Ảnh sự kiện
     * - reward: Phần quà
     * - reward_value: Giá trị mỗi phần quà
     * - reward_quantity: Số lượng phần quà còn lại
     * - start_date: Ngày bắt đầu sự kiện
     * - end_date: Ngày kết thúc sự kiện
     * - status: Trạng thái sự kiện
     *  - `0`: Finished - kết thúc
     *  - `1`: Active - Hoạt động
     * - events_condition: Có điều kiện tham gia hay không (có: `1` hoặc không: `0`)
     *  - Nếu `1`:
     *      - ccv_point: Điểm CCV
     *      - rank_id: Mức xếp hạng yêu cầu
     * - lakechild_id: Hồ câu tổ chức sự kiện
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * ID Sự kiện. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *              "id": 1,
     *              "title": "Sự kiện A",
     *              "picture": "https//core.mevivu.com/hinhanh.jpg",
     *              "reward": "ABC",
     *              "reward_value": 200000,
     *              "reward_quantity": 20,
     *              "start_date": "2024-07-18 00:00:00",
     *              "end_date": "2024-07-28 00:00:00",
     *              "status": 1,
     *              "events_condition": 1,
     *              "ccv_point": 20,
     *              "rank_id": 1,
     *              "user_id": 1,
     *              "lakechild_id": 1
     *         }
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
            $events = $this->repository->findByID($id);
            $events = new ShowEventsResource($events);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $events
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
     * Xóa sự kiện
     *
     * API này cho phép xóa một sự kiện theo ID
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * ID sự kiện. Example: 1
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
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(EventsRequest $request)
    {

        $response = $this->service->delete($request);
        return $response;
    }

    /**
     * Tạo sự kiện mới
     *
     * API này cho phép tạo một sự kiện mới
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam title string required Tiêu đề. Example: Sự kiện A
     * @bodyParam picture string Ảnh sự kiện
     * @bodyParam reward string Phần thưởng
     * @bodyParam reward_value integer Giá trị phần thưởng. Example: 100000
     * @bodyParam reward_quantity integer Số lượng phần thưởng. Example: 10
     * @bodyParam start_date string Thời gian bắt đầu. Example: 1
     * @bodyParam end_date string Thời gian kết thúc. Example: 1
     * @bodyParam events_condition integer Điều kiện. Example: 1
     * @bodyParam status integer Trạng thái. Example: 1
     * @bodyParam ccv_point integer Điểm CCV. Example: 10
     * @bodyParam rank_id integer Xếp loại. Example: 1
     * @bodyParam user_id integer Mã người dùng. Example: 1
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
    public function add(EventsRequest $request)
    {
        $response = $this->service->add($request);
        return $response;
    }


    /**
     * Sửa sự kiện
     *
     * API này cho phép sửa một sự kiện
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam id integer required ID sự kiện. Example: 1
     * @bodyParam title string required Tiêu đề. Example: Sự kiện A
     * @bodyParam picture string Ảnh sự kiện
     * @bodyParam reward string Phần thưởng
     * @bodyParam reward_value integer Giá trị phần thưởng. Example: 100000
     * @bodyParam reward_quantity integer Số lượng phần thưởng. Example: 10
     * @bodyParam start_date string Thời gian bắt đầu. Example: 1
     * @bodyParam end_date string Thời gian kết thúc. Example: 1
     * @bodyParam events_condition integer Điều kiện. Example: 1
     * @bodyParam status integer Trạng thái. Example: 1
     * @bodyParam ccv_point integer Điểm CCV. Example: 10
     * @bodyParam rank_id integer Xếp loại. Example: 1
     * @bodyParam user_id integer Mã người dùng. Example: 1
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
    public function edit(EventsRequest $request)
    {
        $response = $this->service->edit($request);
        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => __('Sửa thành công.')
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Sửa thất bại. Hãy kiểm tra lại.')
        ], 400);
    }
}
