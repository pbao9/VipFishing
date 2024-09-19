<?php

namespace App\Api\V1\Http\Controllers\User;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\User\UserRequest;
use App\Api\V1\Http\Resources\User\AllUserResource;
use App\Api\V1\Http\Resources\User\ShowUserResource;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\User\UserServiceInterface;

/**
 * @group Cần thủ
 */

class UserController extends Controller
{

    public function __construct(
        UserRepositoryInterface $repository,
        UserServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    // /**
    //  * DS Cần thủ
    //  *
    //  * Lấy danh sách Cần Thủ.
    //  *
    //  * @headersParam X-TOKEN-ACCESS string
    //  * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @authenticated Authorization string required
    //  * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
    //  *
    //  * @queryParam page integer
    //  * Trang hiện tại, page > 0. Example: 1
    //  *
    //  * @queryParam limit integer
    //  * Số lượng Withdraws trong 1 trang, limit > 0. Example: 100
    //  *
    //  * @response 200 {
    //  *     "status": 200,
    //  *     "message": "Thực hiện thành công",
    //  *     "data": [
    //  *         {
    //  *             "id": 1,
    //  *             "code": "U2FB711721408700",
    //  *             "username": "nguyenvana",
    //  *             "fullname": "Nguyen Van A",
    //  *             "phone": "0999999999",
    //  *             "email": "example@gmail.com",
    //  *             "address": "123 Quang Trung, Gò Vấp, HCM",
    //  *             "gender": 1,
    //  *             "roles": 1,
    //  *             "status": 1,
    //  *             "rank_id": 1,
    //  *             "bank_id": 1,
    //  *             "bank_number": "1026893534",
    //  *             "ref_status": 0,
    //  *             "discount_user": 0
    //  *         }
    //  *     ]
    //  * }
    //  *
    //  * @response 400 {
    //  *      "status": 400,
    //  *      "message": "Vui lòng kiểm tra lại các trường"
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
    // public function index(UserRequest $request)
    // {
    //     try {
    //         $data = $request->validated();
    //         $users = $this->repository->paginate(...$data);
    //         $users = new AllUserResource($users);
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thực hiện thành công.'),
    //             'data' => $users
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
    //  * Chi tiết Cần thủ
    //  *
    //  * Lấy chi tiết Cần thủ
    //  *
    //  * @headerParam X-TOKEN-ACCESS string required Token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
    //  *
    //  * @pathParam id integer required ID của cần thủ. Example: 1
    //  *
    //  * @response 200 {
    //  *     "status": 200,
    //  *     "message": "Thực hiện thành công",
    //  *     "data": {
    //  *         "id": 1,
    //  *         "code": "U2FB711721408700",
    //  *         "username": "nguyenvana",
    //  *         "fullname": "Nguyen Van A",
    //  *         "phone": "0999999999",
    //  *         "email": "example@gmail.com",
    //  *         "address": "123 Quang Trung, Gò Vấp, HCM",
    //  *         "gender": 1,
    //  *         "roles": 1,
    //  *         "status": 1,
    //  *         "rank_id": 1,
    //  *         "bank_id": 1,
    //  *         "bank_number": "0071001234567",
    //  *         "ref_status": 0,
    //  *         "discount_user": 0
    //  *     }
    //  * }
    //  * 
    //  * @response 400 {
    //  *     "status": 400,
    //  *     "message": "Yêu cầu không hợp lệ"
    //  * }
    //  * 
    //  * @response 403 {
    //  *     "status": 403,
    //  *     "message": "Không có quyền truy cập"
    //  * }
    //  * 
    //  * @response 404 {
    //  *     "status": 404,
    //  *     "message": "Lỗi đường dẫn"
    //  * }
    //  * 
    //  * @response 500 {
    //  *     "status": 500,
    //  *     "message": "Kiểm tra dữ liệu có tồn tại hoặc không!"
    //  * }
    //  *
    //  * @responseSchema application/json
    //  * 
    //  * @authenticated
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int $id
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     try {
    //         $user = $this->repository->findByID($id);
    //         $user = new ShowUserResource($user);
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thực hiện thành công.'),
    //             'data' => $user
    //         ]);
    //     } catch (\Exception $e) {
    //         if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => __('Lỗi đường dẫn')
    //             ]);
    //         }
    //         return response()->json([
    //             'status' => 500,
    //             'message' => __('Kiểm tra dữ liệu có tồn tại hoặc không!')
    //         ]);
    //     }
    // }
}
