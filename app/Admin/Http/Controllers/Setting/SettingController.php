<?php

namespace App\Admin\Http\Controllers\Setting;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(
        SettingRepositoryInterface $repository
    )
    {
        parent::__construct();
        $this->repository = $repository;    
    }
    public function getView()
    {
        return [
            'general' => 'admin.settings.general',
            'user_shopping' => 'admin.settings.user-shopping',
        ];
    }
    public function general(){
        $settings = $this->repository->getByGroup([SettingGroup::General]);

        return view($this->view['general'], compact('settings'));
    }

    public function userShopping(){
        $setting_groups = $this->repository->getByGroup([SettingGroup::UserDiscount, SettingGroup::UserUpgrade])
        ->groupBy('group');
        return view($this->view['user_shopping'], compact('setting_groups'));
    }

    public function update(Request $request){
        $data = $request->except('_token', '_method');
        $this->repository->updateMultipleRecord($data);
        return back()->with('success', __('notifySuccess'));
    }
}