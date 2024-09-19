<?php

namespace App\Api\V1\Http\Controllers\Settings;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Resources\Settings\AllSettingResource;
use App\Api\V1\Repositories\Settings\SettingRepositoryInterface;

/**
 * @group Cài đặt
 */

class SettingController extends Controller
{
    public function __construct(
        SettingRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }
    /**
     * Danh sách cài đặt
     *
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "title": "Hé lộ ios 17 sắp ra mắt",
     *               "slug": "he-lo-ios-17-sap-ra-mat",
     *               "image": "http://localhost/topzone/public/uploads/images/accnhi96141892532044.png",
     *               "is_featured": true,
     *               "excerpt": "Hé lộ ios 17 sắp ra mắt",
     *               "posted_at": "2023-04-19 10:12:57"
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->repository->getAll();
        $settings = new AllSettingResource($settings);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $settings
        ]);
    }
}
