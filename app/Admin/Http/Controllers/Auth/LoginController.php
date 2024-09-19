<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    private $login;
    public function getView(){
        return [
            'index' => 'admin.auth.login'
        ];
    }

    public function index(){
        return view($this->view['index']);
    }

    public function login(LoginRequest $request){

        $this->login = $request->validated();
        
        if($this->resolve()){

            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'))->with('success', __('Đăng nhập thành công'));

        }
        return back()->with('error', __('Tên đăng nhập hoặc mật khẩu không đúng'));
    }

    protected function resolve(){

        return Auth::guard('admin')->attempt($this->login, true) ? true : false;

    }
}
