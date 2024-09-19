<?php

namespace App\Api\V1\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Api\V1\Mail\Auth\ResetPassword;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\Auth\AuthServiceInterface;

/**
 * @group Cần thủ
 */
class ResetPasswordController extends Controller
{
    //
    public function __construct(
        UserRepositoryInterface $repository,
        AuthServiceInterface $service
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }
    public function getRoute()
    {
        return [
            'edit' => 'password.reset.edit',
        ];
    }
    /**
     * Lấy lại mật khẩu
     *
     * Lấy lại mật khẩu khi người dùng quên mật khẩu.
     *
     * 
     * @bodyParam email string required
     * Email Của bạn. Example: example@gmail.com
     * 
     * @response {
     *      "status": 200,
     *      "message": "Thực hiện thành công. Vui lòng kiểm tra email của bạn để lấy lại mật khẩu."
     * }
     *
     * @param  \App\Api\V1\Http\Requests\Auth\ResetPasswordRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function checkAndSendMail(ResetPasswordRequest $request)
    {
        $instance = $this->service->updateTokenPassword($request)
            ->generateRouteGetPassword($this->route['edit'])
            ->getInstance();

        Mail::to($instance['user'])->send(new ResetPassword($instance['user'], $instance['url']));

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công. Vui lòng kiểm tra email của bạn để lấy lại mật khẩu.')
        ]);
    }
}
