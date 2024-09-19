<?php

namespace App\Admin\Repositories\Lakechilds;

use App\Admin\Repositories\EloquentRepository;
use App\Models\ActivitySchedule;

class OperatingRepository extends EloquentRepository implements OperatingRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return ActivitySchedule::class;
    }

    public function findOrFailWithRelations($id, $relations = [])
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'activity_date', 'lake_child_id'])
    {
        $this->instance = $this->model->select($select)
            ->with(['lakechild']);

        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->get();
    }

    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            $query->where('activity_date', 'LIKE', '%' . $key . '%')
                ->orWhere('id', 'LIKE', '%' . $key . '%')
                ->orWhere('lake_child_id', 'LIKE', '%' . $key . '%')
                ->orWhereHas('lakechild', function ($query) use ($key) {
                    $query->where('name', 'LIKE', '%' . $key . '%');
                });
        });
    }
}
