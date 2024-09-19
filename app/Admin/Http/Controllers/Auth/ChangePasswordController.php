<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Admin\Http\Controllers\BaseController;
use App\Admin\Http\Requests\Auth\ChangePasswordRequest;

class ChangePasswordController extends BaseController
{
    //
    public function getView(){
        return [
            'index' => 'admin.auth.password.index'
        ];
    }

    public function index(){
        return view($this->view['index']);
    }

    public function update(ChangePasswordRequest $request){
        $data['password'] = bcrypt($request->input('password'));
        auth('admin')->user()->update($data);
        return back()->with('success', __('notifySuccess'));
    }
}
