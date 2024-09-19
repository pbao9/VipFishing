<?php

namespace App\Admin\Services\Notifications;

use App\Admin\Services\Notifications\NotificationsServiceInterface;
use  App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use Illuminate\Http\Request;

class NotificationsService implements NotificationsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(NotificationsRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){
        $this->data = $request->validated();
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;
        return $this->repository->create($this->data);
    }

    public function update(Request $request){
        
        $this->data = $request->validated();
        $admin = auth('admin')->user();
        $this->data['admin_id'] = $admin->id;
        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}