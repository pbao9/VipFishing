<?php

namespace App\Api\V1\Http\Controllers\TransactionHistory;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\TransactionHistory\TransactionHistoryRequest;
use App\Api\V1\Http\Resources\TransactionHistory\{AllTransactionHistoryResource, ShowTransactionHistoryResource};
use App\Api\V1\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Api\V1\Services\TransactionHistory\TransactionHistoryServiceInterface;
use Illuminate\Http\Request;

/**
 * @group Lịch sử giao dịch
 */

class TransactionHistoryController extends Controller
{
    public function __construct(
        TransactionHistoryRepositoryInterface $repository,
        TransactionHistoryServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Danh sách Lịch sử giao dịch của người dùng
     *
     * API này cho phép truy xuất danh sách tất cả lịch sử giao dịch của người dùng
     *
     * Trong đó có:
     * - user_id: Mã người nạp
     * - transaction_type: Hình thức giao dịch
     *  - `0`: Nạp
     *  - `1`: Rút
     *  - `2`: Tiền hoa hồng
     *  - `3`: Bồi thường
     *  - `4`: Đặt câu
     *  - `5`: Hoàn tiền
     * - amount: Số tiền nạp
     * - balance_after: Số tiền sau khi giao dịch
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @headersParam X-TOKEN-ACCESS stringhttps://sweethome.com.vn/sitemap.xml
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 1,
     *               "user_id": 1,
     *               "transaction_type": 1,
     *               "amount": 10000,
     *               "balance_after": 10000
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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(TransactionHistoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $transactionHistorys = $this->repository->paginate(...$data);
            $transactionHistorys = new AllTransactionHistoryResource($transactionHistorys);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $transactionHistorys
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
     * Chi tiết Lịch sử giao dịch của người dùng
     *
     * API này cho phép truy xuất một lịch sử giao dịch của người dùng theo ID
     *
     * Trong đó có:
     * - user_id: Mã người nạp
     * - transaction_type: Hình thức giao dịch
     *  - `0`: Nạp
     *  - `1`: Rút
     *  - `2`: Tiền hoa hồng
     *  - `3`: Bồi thường
     *  - `4`: Đặt câu
     *  - `5`: Hoàn tiền
     * - amount: Số tiền nạp
     * - balance_after: Số tiền sau khi giao dịch
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @pathParam id integer required ID Lịch sử giao dịch. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "user_id": 1,
     *          "transaction_type": 1,
     *          "amount": 10000,
     *          "balance_after": 10000
     *      }
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        try {
            $user = $request->user();
            $transactionHistory = $user->transactionHistories()->find($id);

            if ($transactionHistory) {
                $transactionHistory = new ShowTransactionHistoryResource($transactionHistory);
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $transactionHistory
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => __('Lịch sử giao dịch không tìm thấy.')
                ]);
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }
}
