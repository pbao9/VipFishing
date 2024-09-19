<?php

namespace App\Api\V1\Http\Controllers\Lakechilds;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Lakechilds\LakechildsRequest;
use App\Api\V1\Http\Resources\Lakechilds\{AllLakechildsResource, ShowLakechildsResource};
use App\Api\V1\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Api\V1\Services\Lakechilds\LakechildsServiceInterface;

/**
 * @group Hồ lẻ
 */

class LakechildsController extends Controller
{
    public function __construct(
        LakechildsRepositoryInterface $repository,
        LakechildsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách hồ lẻ
     *
     * Lấy danh sách hồ lẻ.
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
     *               "name": "Hồ lẻ tiền lâm",
     *               "description": "Mô tả hồ",
     *               "area": 100,
     *               "fish_volume": 10,
     *               "fish_density": 0.1,
     *               "fishing_rod_limit": 10,
     *               "open_time": "Thông tin của Open_time",
     *               "close_time": "Thông tin của Close_time",
     *               "open_day": ["1","2","3"],
     *               "status": 1,
     *               "compensation": 10,
     *               "collect_fish_price": 1500,
     *               "collect_fish_type": 0,
     *               "commission_rate": 10,
     *               "type": 0,
     *               "lake_id": 1,
     *               "fish_id": 1
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
    public function index(LakechildsRequest $request)
    {
        try {
            $lakechilds = $this->repository->getAllLakeChild();
            $lakechilds = new AllLakechildsResource($lakechilds);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $lakechilds
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
     * Chi tiết hồ lẻ
     *
     * API này hiển thị chi tiết Hồ lẻ thông qua ID truyền vào.
     *
     * @authenticated Authorization string required 
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @pathParam id integer required Mã hồ lẻ muốn xem thông tin chi tiết!. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "name": "Thông tin của Name",
     *               "description": "Thông tin của Description",
     *               "area": "Thông tin của Area",
     *               "fish_volume": "Thông tin của Fish_volume",
     *               "fish_density": "Thông tin của Fish_density",
     *               "fishing_rod_limit": "Thông tin của Fishing_rod_limit",
     *               "open_time": "Thông tin của Open_time",
     *               "close_time": "Thông tin của Close_time",
     *               "open_day": "Thông tin của Open_day",
     *               "status": "Thông tin của Status",
     *               "compensation": "Thông tin của Compensation",
     *               "collect_fish_price": "Thông tin của Collect_fish_price",
     *               "collect_fish_type": "Thông tin của Collect_fish_type",
     *               "commission_rate": "Thông tin của Commission_rate",
     *               "type": "Thông tin của Type",
     *               "lake_id": "Thông tin của Lake_id"
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $lakechilds = $this->repository->findByIdWithActivityDay($id);
            $lakechilds = new ShowLakechildsResource($lakechilds);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $lakechilds
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }
}
