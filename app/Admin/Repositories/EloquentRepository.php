<?php

namespace App\Admin\Repositories;

use App\Admin\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class EloquentRepository implements EloquentRepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    /**
     * @var array $select
     */
    protected $select = [];
    /**
     * Current Object instance
     *
     * @var object
     */
    protected $instance;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        //other -> new Model
        $this->model = app()->make(
            $this->getModel()
        );
    }
    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {

        return $this->model->get();
    }
    /**
     * Find records by a specific field.
     *
     * @param string $field The field to filter by.
     * @param mixed $value The value to search for.
     * @param array $relations Optional related models to load.
     * @return Model|null Returns a collection of found records.
     */
    public function findByField(string $field, $value, array $relations = []): ?Model
    {
        return $this->model->where($field, $value)->with($relations)->first();
    }

    /**
     * Find a single record
     *
     * @param int $id
     * @param array $relations
     * @return mixed
     * @throws \Exception
     */
    public function findOrFail($id)
    {
        $this->instance = $this->model->findOrFail($id);
        return $this->instance;
    }
    /**
     * Find a single record
     *
     * @param int $id
     * @param array $relations
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        $this->instance = $this->model->find($id);

        return $this->instance;
    }
    /**
     * Create
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    /**
     * Update
     * @param $id
     * @param array $data
     * @return mixed|bool
     */
    public function update($id, array $data)
    {
        $this->find($id);
        if ($this->instance) {
            $this->instance->update($data);
            return $this->instance;
        }

        return false;
    }
    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $this->find($id);
        if ($this->instance) {
            $this->instance->delete();

            return true;
        }

        return false;
    }
    /**
     * get query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getQueryBuilder()
    {
        $this->instance = $this->model->newQuery();
        return $this->instance;
    }


    public function getBy(array $filter, array $relations = [])
    {

        $this->getByQueryBuilder($filter, $relations);

        return $this->instance->orderBy('id', 'DESC')->get();
    }

    public function getByQueryBuilder(array $filter, array $relations = [])
    {

        $this->getQueryBuilderOrderBy();

        $this->applyFilters($filter);

        return $this->instance->with($relations);
    }

    protected function applyFilters(array $filter)
    {

        foreach ($filter as $field => $value) {
            if (is_array($value)) {

                [$field, $condition, $val] = $value;

                $this->instance = match (strtoupper($condition)) {
                    'IN' => $this->instance->whereIn($field, $val),
                    'NOT_IN' => $this->instance->whereNotIn($field, $val),
                    default => $this->instance->where($field, $condition, $val)
                };
            } else {
                $this->instance = $this->instance->where($field, $value);
            }
        }
    }

    public function where($column, $operator, $value)
    {
        return $this->model->where($column, $operator, $value);
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {

        $this->getQueryBuilder();

        $this->instance = $this->instance->orderBy($column, $sort);

        return $this->instance;
    }


    public function authorize($action = 'view', $guard = 'web')
    {
        if (!$this->instance || auth()->guard($guard)->user()->can($action, $this->instance)) {
            return true;
        }
        if (request()->routeIs('api.*')) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 401,
                    'message' => __('Bạn không có quyền truy cập.')
                ], 401)
            );
        }
        throw new HttpException(401, 'UNAUTHORIZED');
    }

    public function getInstance()
    {
        return $this->instance;
    }
}
