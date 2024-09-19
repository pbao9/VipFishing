<?php

namespace App\Api\V1\Services\Auth;

use App\Admin\Services\File\FileService;
use App\Api\V1\Repositories\UserScores\UserScoresRepository;
use App\Api\V1\Repositories\UserScores\UserScoresRepositoryInterface;
use App\Api\V1\Services\Auth\AuthServiceInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\Balances\BalancesServiceInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

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
    protected $balanceService;
    protected $userScoreRepository;

    protected $instance;
    protected FileService $fileService;

    public function __construct(
        UserRepositoryInterface $repository,
        BalancesServiceInterface $balanceService,
        UserScoresRepositoryInterface $userScoreRepository,
        FileService $fileService,
    ) {
        $this->repository = $repository;
        $this->balanceService = $balanceService;
        $this->userScoreRepository = $userScoreRepository;
        $this->fileService = $fileService;
    }

    public function store(Request $request)
    {

        $this->data = $request->validated();
        $this->data['gender'] = 1;
        $this->data['code'] = $this->createCodeUser();
        if (!isset($this->data['avatar'])) {
            $this->data['avatar'] = config('custom.images.avatar');
        }
        $this->data['status'] = 1;
        $this->data['password'] = bcrypt($this->data['password']);
        $user = $this->repository->create($this->data);
        $userScorce = ['user_id' => $user->id];
        $this->userScoreRepository->create($userScorce);
        return $user;
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        $user = Auth::user();
        Log::info('Mess', ['Mess' => $user]);

        if (isset($this->data['password']) && $this->data['password']) {
            $this->data['password'] = bcrypt($this->data['password']);
        } else {
            unset($this->data['password']);
        }
        if (isset($this->data['avatar'])) {
            $avatar = $this->data['avatar'];
            $this->data['avatar'] = $this->fileService->uploadAvatar('images', $avatar, $user->avatar);
        }

        return $this->repository->update($user->id, $this->data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function updateTokenPassword(Request $request)
    {
        $user = $this->repository->findByKey('email', $request->input('email'));
        $this->data['token_get_password'] = $this->generateTokenGetPassword();
        $this->instance['user'] = $this->repository->updateObject($user, $this->data);
        return $this;
    }

    public function generateRouteGetPassword($routeName)
    {
        $this->instance['url'] = URL::temporarySignedRoute(
            $routeName,
            now()->addMinutes(30),
            [
                'token' => $this->data['token_get_password'],
                'code' => $this->instance['user']->code
            ]
        );
        return $this;
    }

    public function getInstance()
    {
        return $this->instance;
    }
}
