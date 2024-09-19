<?php

namespace App\Api\V1\Repositories\Events;

use App\Admin\Repositories\Events\EventsRepository as AdminEventsRepository;
use App\Api\V1\Repositories\Events\EventsRepositoryInterface;
use App\Models\Events;

class EventsRepository extends AdminEventsRepository implements EventsRepositoryInterface
{
    public function getModel()
    {
        return Events::class;
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