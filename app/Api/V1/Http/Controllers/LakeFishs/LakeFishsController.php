<?php

namespace App\Api\V1\Http\Controllers\LakeFishs;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\LakeFishs\LakeFishsRequest;
use App\Api\V1\Http\Resources\LakeFishs\{AllLakeFishsResource, ShowLakeFishsResource};
use App\Api\V1\Repositories\LakeFishs\LakeFishsRepositoryInterface;
use App\Api\V1\Services\LakeFishs\LakeFishsServiceInterface;
use App\Api\V1\Services\LakeFishs\LakeFishsService;

/**
 * @group Loại cá
 */

class LakeFishsController extends Controller
{
    public function __construct(
        LakeFishsRepositoryInterface $repository,
        LakeFishsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    // /**
    //  * DS QL Cá Thả
    //  *
    //  * Lấy danh sách Cá Thả.
    //  * <ul>
    //  *      <li>Thông tin về hồ thả</li>
    //  *      <li>Thông tin về loại cá thả</li>
    //  * </ul>
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @authenticated Authorization string required
    //  *
    //  * @queryParam page integer
    //  * Trang hiện tại, page > 0. Example: 1
    //  *
    //  * @queryParam limit integer
    //  * Số lượng LakeFishs trong 1 trang, limit > 0. Example: 1
    //  *
    //  *
    //  * @response 200 {
    //  *      "status": 200,
    //  *      "message": "Thực hiện thành công.",
    //  *      "data": [
    //  *         {
    //  *               "id": 4,
    //  *               "lakechild_id": "Thông tin của LakeChild_id",
    //  *               "fish_id": "Thông tin của Fish_id"
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
    // public function index(LakeFishsRequest $request)
    // {
    //     try {
    //         $data = $request->validated();
    //         $lakeFishss = $this->repository->paginate(...$data);
    //         $lakeFishss = new AllLakeFishsResource($lakeFishss);
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thực hiện thành công.'),
    //             'data' => $lakeFishss
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
    //  * Chi tiết QL Cá thả
    //  *
    //  * Lấy chi tiết của Cá thả
    //  *
    //  * <ul>
    //  *      <li>Thông tin về hồ thả</li>
    //  *      <li>Thông tin về loại cá thả</li>
    //  * </ul>
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @authenticated Authorization string required
    //  *
    //  * @pathParam id integer required
    //  * ID cá thả Example: 1
    //  *
    //  *
    //  * @response 200 {
    //  *      "status": 200,
    //  *      "message": "Thực hiện thành công.",
    //  *      "data": [
    //  *         {
    //  *               "id": 4,
    //  *               "lakechild_id": "Thông tin của Lakechild_id",
    //  *               "fish_id": "Thông tin của fish_id"
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
    //         $lakeFishs = $this->repository->findByID($id);
    //         $lakeFishs = new ShowLakeFishsResource($lakeFishs);
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thực hiện thành công.'),
    //             'data' => $lakeFishs
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
    //  * Xóa Cá thả
    //  *
    //  * Xóa Cá thả một Cá thả theo ID
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @authenticated Authorization string required
    //  *
    //  * @queryParam id integer required
    //  * id Cá thả. Example: 1
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
    // public function delete(LakeFishsRequest $request)
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
    //  * Thêm Cá thả
    //  *
    //  * Thêm một Cá thả mới
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @authenticated Authorization string required
    //  *
    //  * @bodyParam lakechild_id integer required
    //  * Mã hồ lẻ Example: 1
    //  * @bodyParam fish_id integer required
    //  * Mã cá Example: 2
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
    // public function add(LakeFishsRequest $request)
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
    //  * Sửa Cá thả
    //  *
    //  * Sửa một Cá thả
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @authenticated Authorization string required
    //  *
    //  * @bodyParam id integer required
    //  * ID Cá thả Example: 1
    //  * @bodyParam lakechild_id
    //  * Mã hồ lẻ Example: 1
    //  * @bodyParam fish_id
    //  * Mã cá Example: 2
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
    // public function edit(LakeFishsRequest $request)
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
