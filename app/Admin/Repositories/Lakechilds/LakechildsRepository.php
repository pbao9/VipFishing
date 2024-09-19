<?php

namespace App\Admin\Repositories\Lakechilds;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Models\FishingSet;
use App\Models\Lakechilds;

class LakechildsRepository extends EloquentRepository implements LakechildsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Lakechilds::class;
    }

    public function findOrFailWithRelations($id, $relations = ['lake', 'fishingSets',])
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }

    public function attachFishingSets(Lakechilds $lakechild, array $fishingSetsId)
    {
        return $lakechild->fishingSets()->attach($fishingSetsId);
    }

    public function syncFishingSets($lakeChild, $fishingSets)
    {
        // Giả sử lakeChild có mối quan hệ nhiều-nhiều với fishingSets
        $lakeChild->fishingSets()->sync($fishingSets);
    }

    public function getAllFishingSets()
    {
        return FishingSet::all();
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function getAllLake()
    {
        return $this->model->all();
    }

    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            $query->where('name', 'LIKE', '%' . $key . '%')
                ->orWhere('id', 'LIKE', '%' . $key . '%')
                ->orWhereHas('lake', function ($query) use ($key) {
                    $query->where('name', 'LIKE', '%' . $key . '%');
                });
        });
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'name', 'compensation', 'lake_id'], $limit = 10)
    {
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->publish()->limit($limit)->get();
    }

    public function getTotalRateValue($lakeChildId)
    {
        $lakeChild = $this->model->findOrFail($lakeChildId);
        return $lakeChild->countRate();
    }

    public function getAvgRateValue($lakeChildId)
    {
        $lakeChild = $this->model->findOrFail($lakeChildId);
        return $lakeChild->avgRating();
    }
}
