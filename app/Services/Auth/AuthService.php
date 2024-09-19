<?php

namespace App\Services\Auth;

use App\Services\Auth\AuthServiceInterface;
use  App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;

class AuthService implements AuthServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(UserRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function updatePassword(Request $request){
        
        $this->data = $request->validated();

        $instance = $this->repository->findBy([
            'code' => $this->data['code'],
            'token_get_password' => $this->data['token']
        ]);

        $password = bcrypt($this->data['password']);

        return $this->repository->updateObject($instance, [
            'password' => $password,
            'token_get_password' => $this->generateTokenGetPassword()
        ]);

    }

}