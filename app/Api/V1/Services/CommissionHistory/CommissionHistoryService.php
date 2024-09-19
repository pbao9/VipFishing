<?php

namespace App\Api\V1\Services\CommissionHistory;

use App\Api\V1\Services\CommissionHistory\CommissionHistoryServiceInterface;
use App\Api\V1\Repositories\CommissionHistory\CommissionHistoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;

class CommissionHistoryService implements CommissionHistoryServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    protected $repository;

    public function __construct(
        CommissionHistoryRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }
    
    public function add(Request $request) {
        $this->data = $request->validated();

        return $this->repository->create($this->data);
    }

	public function edit(Request $request){
        $this->data = $request->validated();

        return (boolean) $this->repository->update($this->data['id'], $this->data);
    }
	
	public function delete(Request $request){
		$this->data = $request->validated();
        return (boolean) $this->repository->delete($this->data['id']);
    }
}