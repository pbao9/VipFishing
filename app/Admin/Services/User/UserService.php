<?php

namespace App\Admin\Services\User;

use App\Admin\Services\Balances\BalancesServiceInterface;
use App\Admin\Services\User\UserServiceInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Repositories\UserScores\UserScoresRepository;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Enums\User\UserRoles;


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
    protected $userscoresRepository;

    public function __construct(
        UserRepositoryInterface $repository,
        BalancesServiceInterface $balanceService,
        UserScoresRepository $userscoresRepository

    ) {
        $this->repository = $repository;
        $this->balanceService = $balanceService;
        $this->userscoresRepository = $userscoresRepository;
    }

    public function store(Request $request)
    {

        $this->data = $request->validated();
        $this->data['code'] = $this->createCodeUser();
        if (!isset($this->data['avatar'])) {
            $this->data['avatar'] = config('custom.images.avatar');
        }
        $this->data['password'] = bcrypt($this->data['password']);
        $user = $this->repository->create($this->data);
        $userScoresData = ['user_id' => $user->id,];
        $this->userscoresRepository->create($userScoresData);
        return $user;
    }

    public function update(Request $request)
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

        return (bool) $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return (bool) $this->repository->delete($id);
    }
}
