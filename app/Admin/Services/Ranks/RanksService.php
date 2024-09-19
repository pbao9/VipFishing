<?php

namespace App\Admin\Services\Ranks;

use App\Admin\Services\Ranks\RanksServiceInterface;
use  App\Admin\Repositories\Ranks\RanksRepositoryInterface;
use Illuminate\Http\Request;

class RanksService implements RanksServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(RanksRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){

        $this->data = $request->validated();
        return $this->repository->create($this->data);
    }

    public function update(Request $request){
        
        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}