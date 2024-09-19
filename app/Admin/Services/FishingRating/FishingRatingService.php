<?php

namespace App\Admin\Services\FishingRating;

use App\Admin\Services\FishingRating\FishingRatingServiceInterface;
use  App\Admin\Repositories\FishingRating\FishingRatingRepositoryInterface;
use Illuminate\Http\Request;


class FishingRatingService implements FishingRatingServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(FishingRatingRepositoryInterface $repository){
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
