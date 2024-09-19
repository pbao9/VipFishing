<?php

namespace App\Admin\Http\Controllers\Order;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Order\OrderDetailRepositoryInterface;

class OrderDetailController extends Controller
{
    public function __construct(
        OrderDetailRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function delete($id = 0){
        return $id && $this->repository->delete($id);
        if($id && $this->repository->delete($id)){
            return response()->json([
                'status' => 200,
                'msg' => __('notifySuccess')
            ], 200);
        }
        return response()->json([
            'status' => 400,
            'msg' => __('notifyFail')
        ], 400);
    }
}