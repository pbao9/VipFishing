<?php

namespace App\Admin\Services\LakeEvents;

use App\Admin\Services\LakeEvents\LakeEventsServiceInterface;
use  App\Admin\Repositories\LakeEvents\LakeEventsRepositoryInterface;
use Illuminate\Http\Request;

class LakeEventsService implements LakeEventsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(LakeEventsRepositoryInterface $repository){
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