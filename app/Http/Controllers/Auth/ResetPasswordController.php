<?php

namespace App\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Auth\AuthServiceInterface;

class ResetPasswordController extends Controller
{
    //
    public function __construct(
        UserRepositoryInterface $repository,
        AuthServiceInterface $service
    )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }
    public function getView()
    {
        return [
            'edit' => 'auth.password.reset.edit',
            'success' => 'auth.password.reset.success',
        ];
    }

    public function getroute()
    {
        return [
            'success' => 'password.reset.success',
        ];
    }
    public function success(){
        return view($this->view['success']);
    }
    public function edit(ResetPasswordRequest $request){
        $data = $request->validated();

        return view($this->view['edit'], $data);
    }

    public function update(ResetPasswordRequest $request){
        $this->service->updatePassword($request);
        return redirect()->route($this->route['success']);
    }
}
