<?php

namespace App\Api\V1\Http\Controllers\Ranks;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Ranks\RanksRequest;
use App\Api\V1\Http\Resources\Ranks\{AllRanksResource, ShowRanksResource};
use App\Api\V1\Repositories\Ranks\RanksRepositoryInterface;
use App\Api\V1\Services\Ranks\RanksServiceInterface;
use App\Api\V1\Services\Ranks\RanksService;

/**
 * @group Xếp loại
 */

class RanksController extends Controller
{
    public function __construct(
        RanksRepositoryInterface $repository,
        RanksServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Danh sách Xếp Loại
     *
     * Lấy danh sách Xếp loại.
     * * <ul>
     *   <li><strong>Cần Thủ Thường</strong>: 
     *     <ul>
     *       <li>Điểm CCV: 10</li>
     *       <li>Số Trận Đã Câu: 0</li>
     *       <li>Số Giải Đạt Được: 0</li>
     *       <li>Số Hồ Đã Câu: 0</li>
     *       <li>Số Tỉnh Đã Câu: 0</li>
     *       <li>Số Lượt Đánh Giá Hồ: 0</li>
     *       <li>Số Điểm HCV: 1</li>
     *       <li>Trạng thái nhận hoa hồng 
     *          <ol>
     *              <li>Không bật nhận hoa hồng</li>
     *              <li>Bật nhận hoa hồng</li>
     *          </ol>
     *       </li>
     *     </ul>
     *   </li>
     *   <li><strong>Chuẩn Cần Thủ</strong>: 
     *     <ul>
     *       <li>Điểm CCV: >20</li>
     *       <li>Số Trận Đã Câu: >3</li>
     *       <li>Số Giải Đạt Được: 0</li>
     *       <li>Số Hồ Đã Câu: >1</li>
     *       <li>Số Tỉnh Đã Câu: >0</li>
     *       <li>Số Lượt Đánh Giá Hồ: >1</li>
     *       <li>Số Điểm HCV: 2</li>
     *       <li>Trạng thái nhận hoa hồng 
     *          <ol>
     *              <li>Không bật nhận hoa hồng</li>
     *              <li>Bật nhận hoa hồng</li>
     *          </ol>
     *       </li>
     *     </ul>
     *   </li>
     *   <li><strong>Đài Sư Cấp 3</strong>: 
     *     <ul>
     *       <li>Điểm CCV: >500</li>
     *       <li>Số Trận Đã Câu: >50</li>
     *       <li>Số Giải Đạt Được: >10</li>
     *       <li>Số Hồ Đã Câu: >10</li>
     *       <li>Số Tỉnh Đã Câu: >3</li>
     *       <li>Số Lượt Đánh Giá Hồ: >10</li>
     *       <li>Số Điểm HCV: 10</li>
     *       <li>Trạng thái nhận hoa hồng 
     *          <ol>
     *              <li>Không bật nhận hoa hồng</li>
     *              <li>Bật nhận hoa hồng</li>
     *          </ol>
     *       </li>
     *     </ul>
     *   </li>
     *   <li><strong>Đài Sư Cấp 2</strong>: 
     *     <ul>
     *       <li>Điểm CCV: >1500</li>
     *       <li>Số Trận Đã Câu: >100</li>
     *       <li>Số Giải Đạt Được: >50</li>
     *       <li>Số Hồ Đã Câu: >25</li>
     *       <li>Số Tỉnh Đã Câu: >10</li>
     *       <li>Số Lượt Đánh Giá Hồ: >50</li>
     *       <li>Số Điểm HCV: 20</li>
     *       <li>Trạng thái nhận hoa hồng 
     *          <ol>
     *              <li>Không bật nhận hoa hồng</li>
     *              <li>Bật nhận hoa hồng</li>
     *          </ol>
     *       </li>
     *     </ul>
     *   </li>
     *   <li><strong>Đài Sư Cấp 1</strong>: 
     *     <ul>
     *       <li>Điểm CCV: >5000</li>
     *       <li>Số Trận Đã Câu: >250</li>
     *       <li>Số Giải Đạt Được: >100</li>
     *       <li>Số Hồ Đã Câu: >50</li>
     *       <li>Số Tỉnh Đã Câu: >25</li>
     *       <li>Số Lượt Đánh Giá Hồ: >100</li>
     *       <li>Số Điểm HCV: 50</li>
     *       <li>Trạng thái nhận hoa hồng 
     *          <ol>
     *              <li>Không bật nhận hoa hồng</li>
     *              <li>Bật nhận hoa hồng</li>
     *          </ol>
     *       </li>
     *     </ul>
     *   </li>
     *   <li><strong>Đặc Cấp Đài Sư</strong>: 
     *     <ul>
     *       <li>Điểm CCV: >10000</li>
     *       <li>Số Trận Đã Câu: >500</li>
     *       <li>Số Giải Đạt Được: >200</li>
     *       <li>Số Hồ Đã Câu: >100</li>
     *       <li>Số Tỉnh Đã Câu: >50</li>
     *       <li>Số Lượt Đánh Giá Hồ: >200</li>
     *       <li>Số Điểm HCV: 100</li>
     *       <li>Trạng thái nhận hoa hồng 
     *          <ol>
     *              <li>Không bật nhận hoa hồng</li>
     *              <li>Bật nhận hoa hồng</li>
     *          </ol>
     *       </li>
     *     </ul>
     *   </li>
     * </ul>
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @authenticated Authorization string required
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 1,
     *               "title": "Cần Thủ Thường",
     *               "hcv_point": 1,
     *               "ccv_point": 10,
     *               "round": 0,
     *               "awards": 0,
     *               "lake": 0,
     *               "province": 0,
     *               "stauts_comission": 2,
     *               "rating": 0
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
    public function index()
    {
        try {
            $ranks = $this->repository->getAll();
            $ranks = new AllRanksResource($ranks);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $ranks
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
