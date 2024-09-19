<?php

namespace App\Api\V1\Http\Controllers\Banks;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Banks\BanksRequest;
use App\Api\V1\Http\Resources\Banks\{AllBanksResource, ShowBanksResource};
use App\Api\V1\Repositories\Banks\BanksRepositoryInterface;
use App\Api\V1\Services\Banks\BanksServiceInterface;
use App\Api\V1\Services\Banks\BanksService;

/**
 * @group Ngân hàng
 */

class BanksController extends Controller
{
    public function __construct(
        BanksRepositoryInterface $repository,
        BanksServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Danh sách ngân hàng
     *
     * Lấy danh sách Ngân hàng.
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 2,
     *               "code": "VCB",
     *               "shortname": "Vietcombank",
     *               "name": "Ngân hàng TMCP Ngoại Thương Việt Nam",
     *               "logo": "https://api.vietqr.io/img/VCB.png",
     *              
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
            $banks = $this->repository->getAll();
            $banks = new AllBanksResource($banks);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $banks
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }
}