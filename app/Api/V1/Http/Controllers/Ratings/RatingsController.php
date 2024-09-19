<?php

namespace App\Api\V1\Http\Controllers\Ratings;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Ratings\RatingsRequest;
use App\Api\V1\Http\Resources\Ratings\{AllRatingsResource, ShowRatingsResource};
use App\Api\V1\Repositories\Ratings\RatingsRepositoryInterface;
use App\Api\V1\Services\Ratings\RatingsServiceInterface;
use App\Api\V1\Services\Ratings\RatingsService;

/**
 * @group Đánh giá hồ
 */
class RatingsController extends Controller
{
    public function __construct(
        RatingsRepositoryInterface $repository,
        RatingsServiceInterface    $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Chi tiết QL ĐÁNH GIÁ
     *
     * API này hiển thị chi tiết Đánh giá thông qua ID truyền vào
     *
     *  Trong đó có:
     *
     *  <strong>rate</strong>: Số sao đánh giá 1-5
     *
     *  <strong>note</strong>: Nội dung đánh giá
     *
     *  <strong>feedback</strong>: Góp ý
     *
     *  <strong>picture</strong>: Ảnh đánh giá
     *
     *  <strong>lake_id</strong>: Mã nhà hồ
     *
     *  <strong>lakechild_id</strong>: Mã hồ lẻ
     *
     *  <strong>booking_id</strong>: Mã đơn đặt câu
     *
     *  <strong>status-(Sự hài lòng)</strong>
     *  <ul>
     *      <li>1: Có</li>
     *      <li>0: Không</li>
     *  </ul>
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required Mã của Đánh giá cần hiển thị thông tin chi tiết. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "rate": 2,
     *               "note": "Quá tệ"
     *               "feedback": "Quá tệ"
     *               "status": "1"
     *               "picture": "/public/assets/images/avatar-user.png",
     *               "lake_id": 1,
     *               "lakechild_id": 2,
     *               "booking_id": 1
     *          }
     *      ]
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
    // public function show($id)
    // {
    //     try {
    //         $ratings = $this->repository->findByID($id);
    //         $ratings = new ShowRatingsResource($ratings);
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thực hiện thành công.'),
    //             'data' => $ratings
    //         ]);
    //     } catch (\Exception $e) {
    //         // Xử lý ngoại lệ nếu cần thiết
    //         return response()->json([
    //             'status' => 500,
    //             'message' => __('Thực hiện thất bại.')
    //         ]);
    //     }
    // }


    /**
     * Xoá Đánh giá
     *
     * API này sẽ cho phép thêm xoá đánh giá
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @queryParam id integer required
     * id Cá thả. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Xoá thành công."
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Xoá thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function delete(RatingsRequest $request)
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

    /**
     * Thêm Đánh giá
     *
     * API này sẽ cho phép thêm một đánh giá mới
     * <p><strong>status</strong> - Trạng thái hài lòng</p>
     * <ul>
     *     <li>0: Không hài lòng</li>
     *     <li>1: Hài lòng</li>
     * </ul>
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam rate string Số sao đánh giá của bạn từ 1 tới 5. Example: 4
     * @bodyParam note string Nội dung đánh giá của bạn. Example: Quá tệ
     * @bodyParam feedback string phản hồi của của bạn. Example: Quá tệ
     * @bodyParam status integer required string Sự hài lòng. Example: 1
     * @bodyParam booking_id integer required Đơn đặt câu. Example: 1
     *
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(RatingsRequest $request)
    {
        $response = $this->service->add($request);

        if ($response['success']) {
            return response()->json([
                'status' => 200,
                'message' => __('Thêm thành công.')
            ]);
        }

        return response()->json([
            'status' => 400,
            'message' => $response['message'] ?? __('Thêm thất bại. Hãy kiểm tra lại.')
        ], 400);
    }

    /**
     * DS Đánh giá theo Hồ
     *
     * API này hiển thị danh sách theo hồ đươc chọn
     *
     *  Trong đó có:
     *
     *  <strong>rate</strong>: Số sao đánh giá 1-5
     *
     *  <strong>note</strong>: Nội dung đánh giá
     *
     *  <strong>feedback</strong>: Góp ý
     *
     *  <strong>picture</strong>: Ảnh đánh giá
     *
     *  <strong>booking_id</strong>: Mã đơn đặt câu
     *
     *  <strong>status-(Sự hài lòng)</strong>
     *  <ul>
     *      <li>1: Có</li>
     *      <li>0: Không</li>
     *  </ul>
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam lake_id integer required ID của Nhà hồ. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "rate": 2,
     *               "note": "Quá tệ",
     *               "feedback": "Quá tệ",
     *               "status": "1",
     *               "picture": "/public/assets/images/avatar-user.png",
     *               "booking_id": 1
     *          },
     *         {
     *               "id": 4,
     *               "rate": 2,
     *               "note": "Quá tệ",
     *               "feedback": "Quá tệ",
     *               "status": "1",
     *               "picture": "/public/assets/images/avatar-user.png",
     *               "booking_id": 1
     *          }
     *      ]
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
    public function find($lake_id)
    {
        try {
            $ratings = $this->repository->findByLakeID($lake_id);

            $ratingsResource = ShowRatingsResource::collection($ratings);

            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $ratingsResource
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ], 500);
        }
    }
}
