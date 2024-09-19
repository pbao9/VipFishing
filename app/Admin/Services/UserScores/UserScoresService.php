<?php

namespace App\Admin\Services\UserScores;

use App\Admin\Services\UserScores\UserScoresServiceInterface;
use  App\Admin\Repositories\UserScores\UserScoresRepositoryInterface;
use Illuminate\Http\Request;

class UserScoresService implements UserScoresServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(UserScoresRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {

        $this->data = $request->validated();
        dd($this->data);
        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id)
    {
        return $this->repository->delete($id);

    }

}
