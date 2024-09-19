<?php

namespace App\Admin\Services\Banks;

use App\Admin\Services\Banks\BanksServiceInterface;
use  App\Admin\Repositories\Banks\BanksRepositoryInterface;
use Illuminate\Http\Request;

class BanksService implements BanksServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(BanksRepositoryInterface $repository){
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