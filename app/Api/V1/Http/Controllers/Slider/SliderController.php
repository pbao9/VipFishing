<?php

namespace App\Api\V1\Http\Controllers\Slider;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Repositories\Slider\SliderRepositoryInterface;
use App\Api\V1\Http\Requests\Slider\SliderRequest;
use App\Api\V1\Http\Resources\Slider\SliderResource;

/**
 * @group Slider
 */

class SliderController extends Controller
{

    public function __construct(
        SliderRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }
    /**
     * Chi tiết slider
     *
     * Lấy chi tiết slider.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @authenticated Authorization string required
     * 
     * @pathParam id integer required
     * id bài viết. Example: 1
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *           "name": "Home page",
     *           "desc": "321",
     *           "items": [
     *               {
     *                   "title": "slider 1",
     *                   "link": "#",
     *                   "image": "http://localhost/topzone/public/uploads/files/img-catesound.png",
     *                   "mobile_image": "http://localhost/topzone/public/uploads/files/airpods-2268.jpeg"
     *               },
     *               {
     *                   "title": "slider 2",
     *                   "link": "#",
     *                   "image": "http://localhost/topzone/public/uploads/files/mac.png",
     *                   "mobile_image": "http://localhost/topzone/public/uploads/files/mac.png"
     *               }
     *           ]
     *       }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {

        $slider = $this->repository->findByPlainKeyWithRelations($key);
        $slider = new SliderResource($slider);
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $slider
        ]);
    }
}
