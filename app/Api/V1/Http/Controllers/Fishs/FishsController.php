<?php

namespace App\Api\V1\Http\Controllers\Fishs;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Fishs\FishsRequest;
use App\Api\V1\Http\Resources\Fishs\{AllFishsResource, ShowFishsResource};
use App\Api\V1\Repositories\Fishs\FishsRepositoryInterface;
use App\Api\V1\Services\Fishs\FishsServiceInterface;

/**
 * @group Loại cá
 */

class FishsController extends Controller
{
    public function __construct(
        FishsRepositoryInterface $repository,
    )
    {
        $this->repository = $repository;
    }

    /**
     * Danh sách Loại Cá
     *
     * Lấy danh sách Loại Cá.
     *
     * API này cho phép bạn lấy danh sách các loại cá có trong một tỉnh cụ thể dựa trên province_code được cung cấp. Dữ liệu trả về bao gồm thông tin chi
     * tiết về từng loại cá như id, name (Tên loại cá) và province_id (Mã tỉnh).
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @response 200
     * {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 1,
     *               "name": "Cá điêu hồng",
     *               "province_id": 79
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(FishsRequest $request)
    {
        try {
            $fishs = $this->repository->getAllFish();
            $fishs = new AllFishsResource($fishs);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $fishs
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
     * Chi tiết Loại Cá
     *
     * API này cho phép bạn lấy thông tin chi tiết về một loại cá dựa trên id được cung cấp.
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @pathParam id integer required
     * ID của Loại Cá Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "name": "Cá Koi",
     *          "province_id": 79,
     *          "variation": [
     *              {
     *                  "id": 1,
     *                  "fish_destiny": 15,
     *                  "fish_price": 4200
     *              },
     *              {
     *                  "id": 2,
     *                  "fish_destiny": 10,
     *                  "fish_price": 3000
     *              },
     *              {
     *                  "id": 3,
     *                  "fish_destiny": 20,
     *                  "fish_price": 5000
     *              }
     *          ]
     *      }
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $fishs = $this->repository->findByIdWithVartiation($id);
            $fishs = new ShowFishsResource($fishs);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $fishs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }
}
