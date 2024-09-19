<?php

namespace App\Admin\Repositories\CloseLakes;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\CloseLakes\CloseLakesRepositoryInterface;
use App\Enums\Bookings\BookingsFishingStatus;
use App\Models\Bookings;
use App\Models\CloseLakes;
use App\Models\FishingSet;
use Illuminate\Support\Carbon;

class CloseLakesRepository extends EloquentRepository implements CloseLakesRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return CloseLakes::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
    public function findOrFailWithRelations($id, $relations = ['bookings'])
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }
    public function getAllBookings(){
        return Bookings::all();
    }
}
