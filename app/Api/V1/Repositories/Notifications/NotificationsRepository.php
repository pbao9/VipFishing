<?php

namespace App\Api\V1\Repositories\Notifications;
use App\Admin\Repositories\Notifications\NotificationsRepository as AdminNotificationsRepository;
use App\Api\V1\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Models\Notifications;

class NotificationsRepository extends AdminNotificationsRepository implements NotificationsRepositoryInterface
{
    public function getModel(){
        return Notifications::class;
    }
	
    public function findByID($id)
    {
        $this->instance = $this->model->where('id', $id)
        ->firstOrFail();
		
        if ($this->instance && $this->instance->exists()) {
			return $this->instance;
		}

		return null;
    }
    public function paginate($page = 1, $limit = 10)
    {
        $page = $page ? $page - 1 : 0;
        $this->instance = $this->model
        ->offset($page * $limit)
        ->limit($limit)
        ->orderBy('id', 'desc')
        ->get();
        return $this->instance;
    }
}