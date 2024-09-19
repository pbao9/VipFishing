<?php

namespace App\Api\V1\Services\User;

use App\Api\V1\Services\Balances\BalancesServiceInterface;
use App\Api\V1\Services\User\UserServiceInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Enums\User\UserRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService implements UserServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    protected $repository;
    protected $balanceService;

    public function __construct(
        UserRepositoryInterface $repository,
        BalancesServiceInterface $balanceService,
    ) {
        $this->repository = $repository;
        $this->balanceService = $balanceService;
    }

    public function add(Request $request)
    {

        $this->data = $request->validated();
        $this->data['code'] = $this->createCodeUser();
        if (!isset($this->data['avatar'])) {
            $this->data['avatar'] = config('custom.images.avatar');
        }
        $this->data['password'] = bcrypt($this->data['password']);

        return $this->repository->create($this->data);
    }

    public function edit(Request $request)
    {

        $this->data = $request->validated();

        if (!isset($this->data['avatar'])) {
            $this->data['avatar'] = config('custom.images.avatar');
        }

        if (isset($this->data['password']) && $this->data['password']) {
            $this->data['password'] = bcrypt($this->data['password']);
        } else {
            unset($this->data['password']);
        }

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete(Request $request)
    {
        $this->data = $request->validated();
        return (boolean) $this->repository->delete($this->data['id']);
    }

}
