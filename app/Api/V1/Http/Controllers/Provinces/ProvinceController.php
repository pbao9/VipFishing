<?php

namespace App\Api\V1\Http\Controllers\Provinces;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Address\ProvinceRequest;
use App\Api\V1\Http\Resources\Address\ProvinceResource;
use App\Api\V1\Repositories\Address\ProvinceRepositoryInterface;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Fishs\FishsRequest;
use App\Api\V1\Http\Resources\Fishs\{AllFishsResource, ShowFishsResource};
use Illuminate\Support\Facades\Log;

/**
 * @group Tỉnh/ Thành, Quận/ Huyện
 */

class ProvinceController extends Controller
{
    public function __construct(
        ProvinceRepositoryInterface $repository

    ) {
        $this->repository = $repository;
    }

    /**
     * Danh sách Tỉnh/Thành
     *
     * Hiển thị toàn bộ tỉnh/thành có trong bảng.
     *
     * API này cho phép bạn lấy danh sách tỉnh/thành có trong danh sách. Dữ liệu trả về bao gồm thông tin chi
     * tiết về từng tỉnh/ thành như id, name (Tên tỉnh/thành).
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *              "id": 1,
     *              "name": "Thành phố Hà Nội"
     *         },
     *         {
     *              "id": 2,
     *              "name": "Tỉnh Hà Giang"
     *         }
     *      ]
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Vui lòng kiểm tra lại các trường field."
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

    public function index(ProvinceRequest $request)
    {
        try {
            $province = $this->repository->getAll();
            $provinceResources = ProvinceResource::collection($province);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $provinceResources
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.'),
                'data' => __('Đã xảy ra lỗi' , $e),
            ]);
        }
    }
}
