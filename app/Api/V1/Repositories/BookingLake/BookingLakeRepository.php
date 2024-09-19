<?php

namespace App\Api\V1\Repositories\BookingLake;
use App\Admin\Repositories\BookingLake\BookingLakeRepository as AdminBookingLakeRepository;
use App\Api\V1\Repositories\BookingLake\BookingLakeRepositoryInterface;
use App\Models\BookingLake;

class BookingLakeRepository extends AdminBookingLakeRepository implements BookingLakeRepositoryInterface
{
    public function getModel(){
        return BookingLake::class;
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
    public function paginate($page = 1, $limit = 10, $user_id = null)
    {
        $page = $page ? $page - 1 : 0;
        $query = $this->model;

        if ($user_id !== null) {
            $query = $query->whereHas('booking', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            });
        }

        $this->instance = $query
            ->with('booking')
            ->offset($page * $limit)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();

        return $this->instance;
    }
}