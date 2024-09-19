<?php

namespace App\Api\V1\Http\Controllers\FishingSet;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\FishingSet\FishingSetRequest;
use App\Api\V1\Http\Resources\FishingSet\{AllFishingSetResource, ShowFishingSetResource};
use App\Api\V1\Repositories\FishingSet\FishingSetRepositoryInterface;
use App\Api\V1\Services\FishingSet\FishingSetServiceInterface;
use App\Api\V1\Services\FishingSet\FishingSetService;

/**
 * @group Suất câu
 */

class FishingSetController extends Controller
{
    public function __construct(
        FishingSetRepositoryInterface $repository,
        FishingSetServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    
    /**
     * Danh sách suất câu
     *
     * Lấy danh sách suất câu.
     *
     * @authenticated Authorization string required 
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "title": "Thông tin của Title",
     *               "time_start": "Thông tin của Time_start",
     *               "time_end": "Thông tin của Time_end",
     *               "time_checkin": "Thông tin của Time_checkin",
     *               "duration": "Thông tin của Duration"
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
    public function index(FishingSetRequest $request)
    {
        try {
            $data = $request->validated();
            $fishingSets = $this->repository->paginate(...$data);
            $fishingSets = new AllFishingSetResource($fishingSets);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $fishingSets
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
     * Chi tiết suất câu
     *
     * Lấy chi tiết suất câu
     *
     * @authenticated Authorization string required 
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @pathParam id integer required
     * ID
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "title": "Thông tin của Title",
     *               "time_start": "Thông tin của Time_start",
     *               "time_end": "Thông tin của Time_end",
     *               "time_checkin": "Thông tin của Time_checkin",
     *               "duration": "Thông tin của Duration"
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
            $fishingSet = $this->repository->findByID($id);
            $fishingSet = new ShowFishingSetResource($fishingSet);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $fishingSet
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
    //  * Xóa FishingSet
    //  *
    //  * Xóa FishingSet một FishingSet theo ID
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @pathParam id integer required
    //  * id FishingSet. Ví dụ: 1
    //  *
    //  * @authenticated Authorization string required
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
    // public function delete(FishingSetRequest $request)
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
    //  * Thêm FishingSet
    //  *
    //  * Thêm một FishingSet mới
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @authenticated Authorization string required
    //  *
    //  * @pathParam title VARCHAR(255)
    //  * Tiêu đề
    //  * @pathParam time_start TIME
    //  * Thời gian bắt đầu
    //  * @pathParam time_end TIME
    //  * Thời gian kết thúc
    //  * @pathParam time_checkin TIME
    //  * Thời gian lấy số
    //  * @pathParam duration INT(11)
    //  * Thời lượng
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
    // public function add(FishingSetRequest $request)
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
    //  * Sửa FishingSet
    //  *
    //  * Sửa một FishingSet
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @authenticated Authorization string required
    //  *
    //  * @pathParam title VARCHAR(255)
    //  * Tiêu đề
    //  * @pathParam time_start TIME
    //  * Thời gian bắt đầu
    //  * @pathParam time_end TIME
    //  * Thời gian kết thúc
    //  * @pathParam time_checkin TIME
    //  * Thời gian lấy số
    //  * @pathParam duration INT(11)
    //  * Thời lượng
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
    // public function edit(FishingSetRequest $request)
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
