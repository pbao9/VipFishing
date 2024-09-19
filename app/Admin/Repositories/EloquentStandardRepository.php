<?php

namespace App\Admin\Repositories;

use App\Admin\Repositories\EloquentStandardRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class EloquentStandardRepository implements EloquentStandardRepositoryInterface
{
    protected $status = true;
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    /**
     * Current Mixed instance
     *
     * @var mixed
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
        $this->instance = $this->model->get();
        return $this;
    }
    /**
     * Find a single record
     *
     * @param int $id
     * @param array $relations
     * @return mixed
     * @throws \Exception
     */
    public function findOrFail($id){
        $this->instance = $this->model->findOrFail($id);
        return $this;
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

        return $this;
    }
    /**
     * Create
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $this->instance = $this->model->create($data);
        return $this;
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
        }
        $this->status = false;
        return $this;
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
            
            return $this;
        }

        return $this;
    }
    /**
     * get query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function makeQueryBuilder()
    {
        $this->instance = $this->model->newQuery();
        return $this;
    }
    public function authorize($action = 'view', $guard = 'web'){
        if(!$this->instance || auth()->guard($guard)->user()->can($action, $this->instance)){
            return true;
        }
        if(request()->routeIs('api.*')){
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