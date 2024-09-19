<?php

namespace App\Api\V1\Http\Controllers\PostCategory;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\PostCategory\PostCategoryRequest;
use App\Api\V1\Http\Resources\PostCategory\AllPostCategoryTreeResource;
use App\Api\V1\Http\Resources\PostCategory\ShowCategoryWithPostResource;
use App\Api\V1\Repositories\PostCategory\PostCategoryRepositoryInterface;
use App\Api\V1\Repositories\Post\PostRepositoryInterface;
use \Illuminate\Http\Request;

/**
 * @group Bài viết
 */

class PostCategoryController extends Controller
{
    protected $repositoryProduct;
    protected $repositoryPost;
    public function __construct(
        PostCategoryRepositoryInterface $repository,
        PostRepositoryInterface $repositoryPost
    ) {
        $this->repository = $repository;
        $this->repositoryPost = $repositoryPost;
    }

    /**
     * Danh sách chuyên mục
     *
     * Lấy danh sách chuyên mục.
     *
     * @headersParam X-TOKEN-ACCESS string required
     * token để lấy dữ liệu. Example: 132323
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *               "id": 7,
     *               "name": "parent 3",
     *               "slug": "parent-3",
     *               "children": [
     *                   {
     *                       "id": 8,
     *                       "name": "child 3",
     *                       "slug": "child-3"
     *                   }
     *               ]
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories = $this->repository->getTree();
        $categories = new AllPostCategoryTreeResource($categories);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $categories
        ]);
    }
    /**
     * Chi tiết chuyên mục
     *
     * Lấy chi tiết chuyên mục.
     *
     * @headersParam X-TOKEN-ACCESS string required
     * token để lấy dữ liệu. Example: 132323
     * 
     * @pathParam id integer required
     * id hoặc chuyên mục. Example: 1
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 6,
     *           "name": "children",
     *           "slug": "children",
     *           "parents": [
     *               {
     *                   "id": 7,
     *                   "name": "parent",
     *                   "slug": "parent"
     *               }
     *           ],
     *          "posts": [
     *               {
     *                   "id": 2,
     *                   "title": "iphone 15 sap ra",
     *                   "slug": "iphone-15-sap-ra",
     *                   "image": "http://localhost/topzone/public/assets/images/default-image.png",
     *                   "is_featured": false,
     *                   "excerpt": null,
     *                   "posted_at": "2023-04-18 15:08:56"
     *               }
     *           ]
     *       }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id, PostCategoryRequest $request)
    {
        try {
            $category = $this->repository->findByIdWithAncestorsAndDescendants($id);
            $category = new ShowCategoryWithPostResource($category, $this->repositoryPost);

            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $category
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json([
                'status' => 404,
                'message' => __('Không tìm thấy dữ liệu')
            ], 404);
        }
    }

}
