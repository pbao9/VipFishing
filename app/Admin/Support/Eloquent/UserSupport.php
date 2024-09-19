<?php
namespace App\Admin\Support\Eloquent;

use App\Enums\User\UserVip;

trait UserSupport {

    public function getDiscountProduct($user){
        $repository = app()->make('App\Repositories\Setting\SettingRepositoryInterface');
        $discount = 0;
        if($user){
            $setting = $repository->getAll();
            switch ($user->vip) {
                case UserVip::Default():
                    $discount = $setting->getValueByKey('user_vip_default');
                    break;
                case UserVip::Bronze():
                    $discount = $setting->getValueByKey('user_vip_bronze');
                    break;
                case UserVip::Silver():
                    $discount = $setting->getValueByKey('user_vip_silver');
                    break;
                case UserVip::Gold():
                    $discount = $setting->getValueByKey('user_vip_gold');
                    break;
                case UserVip::Diamond():
                    $discount = $setting->getValueByKey('user_vip_diamond');
                    break;
                default:
                    $discount = 0;
                    break;
            }
        }
        return $discount;
    }

}