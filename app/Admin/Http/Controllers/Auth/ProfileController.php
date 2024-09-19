<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\ProfileRequest;

class ProfileController extends Controller
{
    //
    public function getView(){
        return [
            'index' => 'admin.auth.profile.index'
        ];
    }
    public function index(){

        $auth = auth('admin')->user();

        return view($this->view['index'], compact('auth'));

    }

    public function update(ProfileRequest $request){
        auth('admin')->user()->update($request->validated());
        return back()->with('success', __('notifySuccess'));
    }

}
