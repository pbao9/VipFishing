<?php

namespace App\Api\V1\Http\Controllers\VariationFishs;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\VariationFishs\VariationFishsRequest;
use App\Api\V1\Http\Resources\VariationFishs\{AllVariationFishsResource, ShowVariationFishsResource};
use App\Api\V1\Repositories\VariationFishs\VariationFishsRepositoryInterface;
use App\Api\V1\Services\VariationFishs\VariationFishsServiceInterface;

/**
 * @group Loại cá
 */

class VariationFishsController extends Controller
{
    public function __construct(
        VariationFishsRepositoryInterface $repository,
        VariationFishsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách Mật độ cá
     *
     * Lấy danh sách mật độ của từng loại cá.
     * 
     * @authenticated Authorization string required 
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     * 
     * @queryParam page integer
     * Trang hiện tại, page > 0. Example: 1
     * 
     * @queryParam limit integer
     * Số lượng VariationFishs trong 1 trang, limit > 0. Example: 1
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "fish_id": "Thông tin của Fish_id",
     *               "fish_density": "Thông tin của Fish_density",
     *               "fish_price": "Thông tin của Fish_price"
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
    public function index(VariationFishsRequest $request)
    {
        try {
            $data = $request->validated();
            $variationFishss = $this->repository->paginate(...$data);
            $variationFishss = new AllVariationFishsResource($variationFishss);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $variationFishss
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
     * Chi tiết Mật độ cá
     *
     * Lấy chi tiết Mật độ cá
     *
     * @authenticated Authorization string required 
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     * 
     * @pathParam id integer required
     * ID của mật độ cá Example: 1
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "fish_id": "Thông tin của Fish_id",
     *               "fish_density": "Thông tin của Fish_density",
     *               "fish_price": "Thông tin của Fish_price"
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
            $variationFishs = $this->repository->findByID($id);
            $variationFishs = new ShowVariationFishsResource($variationFishs);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $variationFishs
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
    //  * Xóa Mật độ cá
    //  *
    //  * Xóa Mật độ cá một Mật độ cá theo ID
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  * 
    //  * @authenticated Authorization string required
    //  * 
    //  * @queryParam id integer required
    //  * id Mật độ cá. Example: 1
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
    // public function delete(VariationFishsRequest $request)
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
    //  * Thêm Mật độ cá
    //  *
    //  * Thêm một Mật độ cá mới
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  * 
    //  * @authenticated Authorization string required
    //  * 
    //  * @bodyParam fish_id integer required
    //  * Mã cá Example: 1
    //  * @bodyParam fish_density integer  
    //  * Mật độ cá Example: 1
    //  * @bodyParam fish_price integer  
    //  * Giá cá Example: 1
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
    // public function add(VariationFishsRequest $request)
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
    //  * Sửa Mật độ cá
    //  *
    //  * Sửa một Mật độ cá
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  * 
    //  * @authenticated Authorization string required
    //  * 
    //  * @bodyParam id integer required
    //  * ID Example: 1
    //  * @bodyParam fish_id integer required
    //  * Mã cá Example: 1
    //  * @bodyParam fish_density integer  
    //  * Mật độ cá Example: 1
    //  * @bodyParam fish_price integer  
    //  * Giá cá Example: 1
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
    // public function edit(VariationFishsRequest $request)
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