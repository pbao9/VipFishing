<?php

namespace App\Api\V1\Http\Controllers\Lakes;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Resources\Lakes\{AllLakesResource, ShowLakesResource};
use App\Api\V1\Repositories\Lakes\LakesRepositoryInterface;
use App\Api\V1\Services\Lakes\LakesServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Nhà hồ
 */
class LakesController extends Controller
{
    public function __construct(
        LakesRepositoryInterface $repository,
        LakesServiceInterface    $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách Nhà hồ
     *
     * API này cho phép truy xuất danh sách toàn bộ danh sách nhà hồ, tổng hồ lẻ có trong nhà hồ <br>
     *  <p><strong>total_lakechild</strong> - Tổng số hồ lẻ có trong nhà hồ</p>
     *  <p><strong>lake_child</strong> - Dữ liệu hồ lẻ trong nhà hồ</p>
     *  <ul>
     *      <li><strong>open_day</strong> - Ngày mở cửa (T2 -> CN).
     *          <ol>
     *              <li>Thứ 2</li>
     *              <li>Thứ 3</li>
     *              <li>Thứ 4</li>
     *              <li>Thứ 5</li>
     *              <li>Thứ 6</li>
     *              <li>Thứ 7</li>
     *              <li>Chủ nhật</li>
     *           </ol>
     *      </li>
     *      <li><strong>operating</strong> - Danh sách các ngày mở cửa: 09/09/24, 10/09/24 (Sẽ tạo ra 3 tháng)</li>
     *  </ul>
     *  <p><strong>fish</strong> - Loại cá thả trong hồ</p>
     *  <ul>
     *      <li><strong>variations</strong> - Mật độ cá thả và số tiền của mật độ cá đó</li>
     *  </ul>
     *  <p><strong>latitude</strong> - Vĩ độ của hồ</p>
     *  <p><strong>longitude</strong> - Kinh độ của hồ</p>
     *  <p><strong>avg_rating</strong> - Điểm đánh giá trung bình của Nhà hồ</p>
     *  <p><strong>total_rating</strong> - Tổng đánh giá của Nhà hồ</p>
     *  <p><strong>lunch - (Suất ăn trưa)</strong></p>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     *  <strong>dinner - (Suất ăn chiều)</strong>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     *  <strong>toilet - (Suất ăn chiều)</strong>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *               "id": 1,
     *               "name": "Nhà hồ thanh thông thả",
     *               "phone": "0901111111",
     *               "province_id": 1,
     *               "map": "998 Đường Quang Trung, phường 8, Gò Vấp, Hồ Chí Minh, Việt Nam",
     *               "description": "<p>Mô tả</p>",
     *               "car_parking": 30,
     *               "dinner": 1,
     *               "lunch": 1,
     *               "toilet": 1,
     *               "avatar": "http://localhost:8080/2772-CauCa/public/uploads/images/1680232194785-kinh%20nghi%E1%BB%87m%20m%E1%BB%9F%20h%E1%BB%93%20c%C3%A2u%20c%C3%A1.jpg",
     *               "status": 1,
     *               "avg_rating": 0,
     *               "total_rating": 0,
     *               "latitude": 106.647103,
     *               "longitude": 10.83946,
     *               "total_lakechild": 2,
     *               "lake_child": [
     *                   {
     *                       "id": 1,
     *                       "name": "Hồ lẻ 1",
     *                       "description": "<p>Mô tả</p>",
     *                       "area": 400,
     *                       "fish_volume": 4200,
     *                       "fish_density": 10.5,
     *                       "fishing_rod_limit": 3,
     *                       "open_time": "07:00:00",
     *                       "close_time": "12:00:00",
     *                       "avg_rating": 0,
     *                       "total_rating": 0,
     *                       "open_day": [
     *                           "1"
     *                       ],
     *                       "status": 1,
     *                       "compensation": 20,
     *                       "collect_fish_price": 2500,
     *                       "collect_fish_type": 0,
     *                       "commission_rate": 0,
     *                       "type": 0,
     *                       "fish": {
     *                           "fish_id": 1,
     *                           "province_id": 1
     *                       }
     *                   },
     *                   {
     *                       "id": 2,
     *                       "name": "Hồ lẻ 2",
     *                       "description": "<p>Mô tả</p>",
     *                       "area": 400,
     *                       "fish_volume": 5200,
     *                       "fish_density": 13,
     *                       "fishing_rod_limit": 3,
     *                       "open_time": "08:00:00",
     *                       "close_time": "12:00:00",
     *                       "open_day": [
     *                          "2",
     *                          "3"
     *                       ],
     *                       "status": 1,
     *                       "compensation": 20,
     *                       "collect_fish_price": 30000,
     *                       "collect_fish_type": 0,
     *                       "commission_rate": 0,
     *                       "type": 0,
     *                       "fish": {
     *                            "fish_id": 1,
     *                            "province_id": 1
     *                        }
     *                   }
     *               ]
     *      }
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Vui lòng kiểm tra lại các trường"
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $lakes = $this->repository->getListLakeWithFish();
            $lakes = new AllLakesResource($lakes);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $lakes
            ]);
        } catch (Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }

    /**
     * Chi tiết Nhà hồ
     *
     * API này hiển thị chi tiết Nhà hồ thông qua ID truyền vào. Trong đó:<br/>
     *  <p><strong>total_lakechild</strong> - Tổng số hồ lẻ có trong nhà hồ</p>
     *  <p><strong>lake_child</strong> - Dữ liệu hồ lẻ trong nhà hồ</p>
     *  <ul>
     *      <li><strong>open_day</strong> - Ngày mở cửa (T2 -> CN).
     *          <ol>
     *              <li>Thứ 2</li>
     *              <li>Thứ 3</li>
     *              <li>Thứ 4</li>
     *              <li>Thứ 5</li>
     *              <li>Thứ 6</li>
     *              <li>Thứ 7</li>
     *              <li>Chủ nhật</li>
     *           </ol>
     *      </li>
     *      <li><strong>operating</strong> - Danh sách các ngày mở cửa: 09/09/24, 10/09/24 (Sẽ tạo ra 3 tháng)</li>
     *  </ul>
     *  <p><strong>fish</strong> - Loại cá thả trong hồ</p>
     *  <ul>
     *      <li><strong>variations</strong> - Mật độ cá thả và số tiền của mật độ cá đó</li>
     *  </ul>
     *  <p><strong>latitude</strong> - Vĩ độ của hồ</p>
     *  <p><strong>longitude</strong> - Kinh độ của hồ</p>
     *  <p><strong>avg_rating</strong> - Điểm đánh giá trung bình của Nhà hồ</p>
     *  <p><strong>total_rating</strong> - Tổng đánh giá của Nhà hồ</p>
     *  <p><strong>lunch - (Suất ăn trưa)</strong></p>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     *  <strong>dinner - (Suất ăn chiều)</strong>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     *  <strong>toilet - (Suất ăn chiều)</strong>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     *
     * @headersParam X-TOKEN-ACCESS string
     * Token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated Authorization string required
     *
     * @pathParam id integer required Mã của Nhà hồ cần hiển thị thông tin chi tiết. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *               "id": 1,
     *               "name": "Nhà hồ thanh thông thả",
     *               "phone": "0901111111",
     *               "province_id": 1,
     *               "map": "998 Đường Quang Trung, phường 8, Gò Vấp, Hồ Chí Minh, Việt Nam",
     *               "description": "<p>Mô tả</p>",
     *               "car_parking": 30,
     *               "dinner": 1,
     *               "lunch": 1,
     *               "toilet": 1,
     *               "avatar": "http://localhost:8080/2772-CauCa/public/uploads/images/1680232194785-kinh%20nghi%E1%BB%87m%20m%E1%BB%9F%20h%E1%BB%93%20c%C3%A2u%20c%C3%A1.jpg",
     *               "status": 1,
     *               "avg_rating": 0,
     *               "total_rating": 0,
     *               "latitude": 106.647103,
     *               "longitude": 10.83946,
     *               "total_lakechild": 2,
     *               "lake_child": [
     *                   {
     *                       "id": 1,
     *                       "name": "Hồ lẻ 1",
     *                       "description": "<p>Mô tả</p>",
     *                       "area": 400,
     *                       "fish_volume": 4200,
     *                       "fish_density": 10.5,
     *                       "fishing_rod_limit": 3,
     *                       "open_time": "07:00:00",
     *                       "close_time": "12:00:00",
     *                       "avg_rating": 0,
     *                       "total_rating": 0,
     *                       "open_day": [
     *                           "1"
     *                       ],
     *                       "operating": [
     *                           {"date": "2024-09-01"},
     *                           {"date": "2024-09-02"},
     *                           {"date": "2024-09-03"},
     *                           {"date": "2024-09-04"},
     *                           {"date": "2024-09-05"},
     *                           {"date": "2024-09-06"}
     *                       ],
     *                       "status": 1,
     *                       "compensation": 20,
     *                       "collect_fish_price": 2500,
     *                       "collect_fish_type": 0,
     *                       "commission_rate": 0,
     *                       "type": 0,
     *                       "fish": {
     *                           "fish_id": 1,
     *                           "province_id": 1
     *                       }
     *                   },
     *                   {
     *                       "id": 2,
     *                       "name": "Hồ lẻ 2",
     *                       "description": "<p>Mô tả</p>",
     *                       "area": 400,
     *                       "fish_volume": 5200,
     *                       "fish_density": 13,
     *                       "fishing_rod_limit": 3,
     *                       "open_time": "08:00:00",
     *                       "close_time": "12:00:00",
     *                       "open_day": [
     *                          "2",
     *                          "3"
     *                       ],
     *                       "operating": [
     *                            {"date": "2024-09-01"},
     *                            {"date": "2024-09-02"},
     *                            {"date": "2024-09-03"},
     *                            {"date": "2024-09-04"},
     *                            {"date": "2024-09-05"},
     *                            {"date": "2024-09-06"}
     *                        ],
     *                       "status": 1,
     *                       "compensation": 20,
     *                       "collect_fish_price": 30000,
     *                       "collect_fish_type": 0,
     *                       "commission_rate": 0,
     *                       "type": 0,
     *                       "fish": {
     *                            "fish_id": 1,
     *                            "province_id": 1
     *                        }
     *                   }
     *               ]
     *      }
     * }
     *
     * @response 400 {
     *      "status": 400,
     *      "message": "Vui lòng kiểm tra lại các trường"
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $lakes = $this->repository->findByIdWithLakechilds($id);
            $lakes = new ShowLakesResource($lakes);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $lakes
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.'),
                'error' => $e->getMessage()
            ]);
        }
    }


    /**
     * Tìm kiếm nhà hồ
     *
     * API trả về dữ liệu của nhà hồ được tìm kiếm thông qua Loại cá, Tỉnh, Sắp xếp theo điểm đánh giá
     *  <p><strong>total_lakechild</strong> - Tổng số hồ lẻ có trong nhà hồ</p>
     *  <p><strong>lake_child</strong> - Dữ liệu hồ lẻ trong nhà hồ</p>
     *  <ul>
     *      <li><strong>open_day</strong> - Ngày mở cửa (T2 -> CN).
     *          <ol>
     *              <li>Thứ 2</li>
     *              <li>Thứ 3</li>
     *              <li>Thứ 4</li>
     *              <li>Thứ 5</li>
     *              <li>Thứ 6</li>
     *              <li>Thứ 7</li>
     *              <li>Chủ nhật</li>
     *           </ol>
     *      </li>
     *      <li><strong>operating</strong> - Danh sách các ngày mở cửa: 09/09/24, 10/09/24 (Sẽ tạo ra 3 tháng)</li>
     *  </ul>
     *  <p><strong>fish</strong> - Loại cá thả trong hồ</p>
     *  <ul>
     *      <li><strong>variations</strong> - Mật độ cá thả và số tiền của mật độ cá đó</li>
     *  </ul>
     *  <p><strong>latitude</strong> - Vĩ độ của hồ</p>
     *  <p><strong>longitude</strong> - Kinh độ của hồ</p>
     *  <p><strong>avg_rating</strong> - Điểm đánh giá trung bình của Nhà hồ</p>
     *  <p><strong>total_rating</strong> - Tổng đánh giá của Nhà hồ</p>
     *  <p><strong>lunch - (Suất ăn trưa)</strong></p>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     *  <strong>dinner - (Suất ăn chiều)</strong>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     *  <strong>toilet - (Suất ăn chiều)</strong>
     *  <ul>
     *       <li>1: Có</li>
     *       <li>2: Không</li>
     *  </ul>
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @queryParam province_id integer
     * Mã tỉnh. Example: 79
     *
     * @queryParam fish_id integer
     * Mã cá. Example: 1
     *
     *
     * @queryParam order_by string
     * Cột để sắp xếp. Mặc định là 'total_rating'. Example: total_rating
     *
     * @queryParam direction string
     * Hướng sắp xếp, có thể là 'asc' hoặc 'desc'. Mặc định là 'desc'. Example: desc
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *               "id": 1,
     *               "name": "Nhà hồ thanh thông thả",
     *               "phone": "0901111111",
     *               "province_id": 1,
     *               "map": "998 Đường Quang Trung, phường 8, Gò Vấp, Hồ Chí Minh, Việt Nam",
     *               "description": "<p>Mô tả</p>",
     *               "car_parking": 30,
     *               "dinner": 1,
     *               "lunch": 1,
     *               "toilet": 1,
     *               "avatar": "http://localhost:8080/2772-CauCa/public/uploads/images/1680232194785-kinh%20nghi%E1%BB%87m%20m%E1%BB%9F%20h%E1%BB%93%20c%C3%A2u%20c%C3%A1.jpg",
     *               "status": 1,
     *               "avg_rating": 0,
     *               "total_rating": 0,
     *               "latitude": 106.647103,
     *               "longitude": 10.83946,
     *               "total_lakechild": 2,
     *               "lake_child": [
     *                   {
     *                       "id": 1,
     *                       "name": "Hồ lẻ 1",
     *                       "description": "<p>Mô tả</p>",
     *                       "area": 400,
     *                       "fish_volume": 4200,
     *                       "fish_density": 10.5,
     *                       "fishing_rod_limit": 3,
     *                       "open_time": "07:00:00",
     *                       "close_time": "12:00:00",
     *                       "avg_rating": 0,
     *                       "total_rating": 0,
     *                       "open_day": [
     *                           "1"
     *                       ],
     *                       "status": 1,
     *                       "compensation": 20,
     *                       "collect_fish_price": 2500,
     *                       "collect_fish_type": 0,
     *                       "commission_rate": 0,
     *                       "type": 0,
     *                       "fish": {
     *                           "fish_id": 1,
     *                           "province_id": 1
     *                       }
     *                   },
     *                   {
     *                       "id": 2,
     *                       "name": "Hồ lẻ 2",
     *                       "description": "<p>Mô tả</p>",
     *                       "area": 400,
     *                       "fish_volume": 5200,
     *                       "fish_density": 13,
     *                       "fishing_rod_limit": 3,
     *                       "open_time": "08:00:00",
     *                       "close_time": "12:00:00",
     *                       "open_day": [
     *                          "2",
     *                          "3"
     *                       ],
     *                       "status": 1,
     *                       "compensation": 20,
     *                       "collect_fish_price": 30000,
     *                       "collect_fish_type": 0,
     *                       "commission_rate": 0,
     *                       "type": 0,
     *                       "fish": {
     *                            "fish_id": 1,
     *                            "province_id": 1
     *                        }
     *                   }
     *               ]
     *      }
     * }
     * 
     * @response 400 {
     *      "status": 400,
     *      "message": "Vui lòng kiểm tra lại các trường"
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        try {
            $criteria = $request->only(['province_id', 'fish_id']);
            $orderBy = $request->get('order_by', 'total_rating');
            $direction = $request->get('direction', 'desc');

            $lakes = $this->repository->findAndSearchWithRelation(null, $criteria, $orderBy, $direction);
            $lakesResource = new AllLakesResource($lakes);

            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $lakesResource
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.'),
                'error' => $e->getMessage()
            ]);
        }
    }
}
