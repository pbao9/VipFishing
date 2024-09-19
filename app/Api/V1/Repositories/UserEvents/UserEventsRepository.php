<?php

namespace App\Api\V1\Repositories\UserEvents;
use App\Admin\Repositories\UserEvents\UserEventsRepository as AdminUserEventsRepository;
use App\Api\V1\Repositories\UserEvents\UserEventsRepositoryInterface;
use App\Models\UserEvents;

class UserEventsRepository extends AdminUserEventsRepository implements UserEventsRepositoryInterface
{
    public function getModel(){
        return UserEvents::class;
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
