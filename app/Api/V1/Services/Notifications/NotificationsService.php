<?php

namespace App\Api\V1\Services\Notifications;

use App\Api\V1\Services\Notifications\NotificationsServiceInterface;
use App\Api\V1\Repositories\Notifications\NotificationsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Support\AuthSupport;

class NotificationsService implements NotificationsServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(
        NotificationsRepositoryInterface $repository,
    ){
        $this->repository = $repository;
    }
    
    public function add(Request $request){
		$this->data = $request->validated();
        $user = $request->user();
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;
        $this->data['user_id'] = $user->id;
		try {
			$this->repository->create($this->data);
			return 1;
		} catch (\Exception $e) {
			// Xử lý ngoại lệ nếu cần thiết
			return 0;
		}	
    }

	public function edit(Request $request){
        $this->data = $request->validated();
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;
		try {			
			$this->repository->update($this->data['id'], $this->data);
			// Trả về thông báo thành công hoặc dữ liệu đã cập nhật
			return 1;
		} catch (\Exception $e) {
			// Xử lý ngoại lệ nếu cần thiết
			return 0;
		}
    }
	
	public function delete(Request $request){
		$this->data = $request->validated();
        try {
            $this->repository->delete($this->data['id']);
            return 1;
        } catch (\Exception $e) {
            return 0;
        } 
    }
}