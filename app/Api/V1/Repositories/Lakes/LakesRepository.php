<?php

namespace App\Api\V1\Repositories\Lakes;

use App\Admin\Repositories\Lakes\LakesRepository as AdminLakesRepository;
use App\Api\V1\Repositories\Lakes\LakesRepositoryInterface;
use App\Models\Lakes;

class LakesRepository extends AdminLakesRepository implements LakesRepositoryInterface
{
    public function getModel()
    {
        return Lakes::class;
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

    public function getListLakeWithFish()
    {
        $this->instance = $this->model->with([
            'lakechilds.fish'
        ])->get();

        return $this->instance;
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

    public function findByIdWithLakechilds($id)
    {
        return $this->model::with([
            'lakechilds.fish.variationFishes',
            'lakechilds.activityDates',
        ])->findOrFail($id);
    }


    public function findAndSearchWithRelation($id = null, array $criteria = [], $orderBy = 'total_rating', $direction = 'desc')
    {
        $query = $this->model::with(['lakechilds.fish']);

        if ($id) {
            $result = $query->findOrFail($id);
            return $result;
        }

        if (isset($criteria['province_id'])) {
            $query->where('province_id', $criteria['province_id']);
        }

        if (isset($criteria['fish_id'])) {
            $query->whereHas('lakechilds', function ($query) use ($criteria) {
                $query->where('fish_id', $criteria['fish_id']);
            });
        }

        // Thêm sắp xếp theo tổng số đánh giá
        $query->withCount('ratings')->orderBy('ratings_count', $direction);

        $results = $query->get();

        if ($results->isEmpty()) {
            throw new \Exception('Dữ liệu không tồn tại!');
        }

        return $results;
    }
}
