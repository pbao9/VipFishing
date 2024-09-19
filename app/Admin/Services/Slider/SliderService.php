<?php

namespace App\Admin\Services\Slider;

use App\Admin\Services\Slider\SliderServiceInterface;
use  App\Admin\Repositories\Slider\SliderRepositoryInterface;
use Illuminate\Http\Request;

class SliderService implements SliderServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(SliderRepositoryInterface $repository){
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