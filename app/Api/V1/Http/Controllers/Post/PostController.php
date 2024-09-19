<?php

namespace App\Api\V1\Http\Controllers\Post;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Post\PostRequest;
use App\Api\V1\Http\Resources\Post\{AllPostResource, ShowPostResource};
use App\Api\V1\Repositories\Post\PostRepositoryInterface;

/**
 * @group Bài viết
 */

class PostController extends Controller
{
    public function __construct(
        PostRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }
    /**
     * DS bài viết
     *
     * Lấy danh sách bài viết.
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @queryParam page integer
     * Trang hiện tại, page > 0. Example: 1
     * 
     * @queryParam limit integer
     * Số lượng bài viết trong 1 trang, limit > 0. Example: 1
     * 
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
    public function index(PostRequest $request)
    {
        $data = $request->validated();

        $posts = $this->repository->paginate(...$data);
        $posts = new AllPostResource($posts);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $posts
        ]);
    }
    /**
     * DS bài viết nổi bật
     *
     * Lấy danh sách bài viết nổi bật.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @queryParam page integer
     * Trang hiện tại, page > 0. Example: 1
     * 
     * @queryParam limit integer
     * Số lượng bài viết trong 1 trang, limit > 0. Example: 1
     * 
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
    public function featured(PostRequest $request)
    {
        $data = $request->validated();

        $posts = $this->repository->getFeaturedPaginate(...$data);
        $posts = new AllPostResource($posts);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $posts
        ]);
    }
    /**
     * Chi tiết bài viết
     *
     * Lấy chi tiết bài viết.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam id integer required
     * id bài viết. Example: 1
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *           "id": 4,
     *           "title": "Hé lộ ios 17 sắp ra mắt",
     *           "slug": "he-lo-ios-17-sap-ra-mat",
     *           "image": "http://localhost/topzone/public/uploads/images/1597766959764584432044.png",
     *           "is_featured": true,
     *           "excerpt": "Hé lộ ios 17 sắp ra mắt",
     *           "content": "<p>H&eacute; lộ ios 17 sắp ra mắt</p>",
     *           "posted_at": "2023-04-19 10:12:57"
     *       }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->repository->findByPublished($id);
        $post = new ShowPostResource($post);
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $post
        ]);
    }
    /**
     * DS bài viết liên quan
     *
     * Lấy danh sách bài viết liên quan.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam id integer required
     * id bài viết. Example: 1
     * 
     * @queryParam page integer
     * Trang hiện tại, page > 0. Example: 1
     * 
     * @queryParam limit integer
     * Số lượng bài viết trong 1 trang, limit > 0. Example: 1
     * 
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
    public function related($id, PostRequest $request)
    {

        $posts = $this->repository->getRelated($id, ...$request->validated());
        $posts = new AllPostResource($posts);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $posts
        ]);
    }
}
