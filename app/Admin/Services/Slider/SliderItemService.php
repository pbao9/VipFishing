<?php

namespace App\Admin\Services\Slider;

use App\Admin\Services\Slider\SliderItemServiceInterface;
use  App\Admin\Repositories\Slider\SliderItemRepositoryInterface;
use Illuminate\Http\Request;

class SliderItemService implements SliderItemServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(SliderItemRepositoryInterface $repository){
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