<?php

namespace App\Api\V1\Http\Controllers\UserScores;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\UserScores\UserScoresRequest;
use App\Api\V1\Http\Resources\UserScores\{AllUserScoresResource, ShowUserScoresResource};
use App\Api\V1\Repositories\UserScores\UserScoresRepositoryInterface;
use App\Api\V1\Services\UserScores\UserScoresServiceInterface;
use App\Api\V1\Services\UserScores\UserScoresService;

/**
 * @group Điểm cần thủ
 */

class UserScoresController extends Controller
{
    public function __construct(
        UserScoresRepositoryInterface $repository,
        UserScoresServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * DS QL ĐIỂM
     *
     * Lấy danh sách UserScores.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @queryParam page integer
     * Trang hiện tại, page > 0. Ví dụ: 1
     *
     * @queryParam limit integer
     * Số lượng UserScores trong 1 trang, limit > 0. Ví dụ: 1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "user_id": "Thông tin của User_id",
     *               "total_ccv": "Thông tin của Total_ccv",
     *               "total_round": "Thông tin của Total_round",
     *               "total_hcv": "Thông tin của Total_hcv",
     *               "total_awards": "Thông tin của Total_awards",
     *               "total_lake": "Thông tin của Total_lake",
     *               "total_province": "Thông tin của Total_province",
     *               "total_rating": "Thông tin của Total_rating"
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
    public function index(UserScoresRequest $request)
    {
        try {
            $data = $request->validated();
            $userScoress = $this->repository->paginate(...$data);
            $userScoress = new AllUserScoresResource($userScoress);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $userScoress
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
     * Chi tiết QL ĐIỂM
     *
     * Lấy chi tiết UserScores
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * ID
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "user_id": "Thông tin của User_id",
     *               "total_ccv": "Thông tin của Total_ccv",
     *               "total_round": "Thông tin của Total_round",
     *               "total_hcv": "Thông tin của Total_hcv",
     *               "total_awards": "Thông tin của Total_awards",
     *               "total_lake": "Thông tin của Total_lake",
     *               "total_province": "Thông tin của Total_province",
     *               "total_rating": "Thông tin của Total_rating"
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
            $userScores = $this->repository->findByID($id);
            $userScores = new ShowUserScoresResource($userScores);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $userScores
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
     * Xóa UserScores
     *
     * Xóa UserScores một UserScores theo ID
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * id UserScores. Ví dụ: 1
     *
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
    public function delete(UserScoresRequest $request)
    {

        $response = $this->repository->delete($request);

        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => __('Xóa thành công.')
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Xóa thất bại.')
        ]);
    }

    /**
     * Thêm UserScores
     *
     * Thêm một UserScores mới
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam user_id INT(11)
     * Mã người dùng
     * @pathParam total_ccv INT(11)
     * Tổng điểm CCV
     * @pathParam total_round INT(11)
     * Tổng trận thi đấu
     * @pathParam total_hcv INT(11)
     * Tổng điểm HCV
     * @pathParam total_awards INT(11)
     * Tổng phần thưởng
     * @pathParam total_lake INT(11)
     * Tổng số hồ câu
     * @pathParam total_province INT(11)
     * Tổng số tỉnh câu
     * @pathParam total_rating INT(11)
     * Tổng số lượt đánh giá
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
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function add(UserScoresRequest $request)
    {
        $response = $this->service->add($request);
        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => __('Thêm thành công.')
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Thêm thất bại. Hãy kiểm tra lại.')
        ], 400);
    }


    /**
     * Sửa UserScores
     *
     * Sửa một UserScores
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     *
     * @pathParam user_id INT(11)
     * Mã người dùng
     * @pathParam total_ccv INT(11)
     * Tổng điểm CCV
     * @pathParam total_round INT(11)
     * Tổng trận thi đấu
     * @pathParam total_hcv INT(11)
     * Tổng điểm HCV
     * @pathParam total_awards INT(11)
     * Tổng phần thưởng
     * @pathParam total_lake INT(11)
     * Tổng số hồ câu
     * @pathParam total_province INT(11)
     * Tổng số tỉnh câu
     * @pathParam total_rating INT(11)
     * Tổng số lượt đánh giá
     *
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
    public function edit(UserScoresRequest $request)
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
