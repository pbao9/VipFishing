<?php
namespace App\Api\V1\Support;

use App\Enums\User\UserVip;

trait AuthSupport {

    public function getDiscountProduct(){
        $repository = app()->make('App\Repositories\Setting\SettingRepositoryInterface');
        $auth = auth()->user();
        $discount = 0;
        if($auth){
            $setting = $repository->getAll();
            switch ($auth->vip) {
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