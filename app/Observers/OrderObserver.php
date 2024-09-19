<?php

namespace App\Observers;

use App\Enums\Order\OrderStatus;
use App\Enums\User\UserVip;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Repositories\Setting\SettingRepositoryInterface;

class OrderObserver
{
    protected $repositorySetting;
    public function __construct(SettingRepositoryInterface $repositorySetting)
    {
        $this->repositorySetting = $repositorySetting;
    }
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //

        if($order->status == OrderStatus::Completed() && !$order->checkEarningPoint()){
            $orderDetails = $order->orderDetails()->get();

            $point = 0;
            
            foreach($orderDetails as $item){
                if($item->detail['product']['is_earning_point']){
                    $point += $item->qty;
                }
            }
            DB::table('order_earning_point')->insert([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'point' => $point
            ]);
            if($point > 0){
                $setting = $this->repositorySetting->getAll();
                $user = $order->user;
                $point = $user->sumEarningPoint();
                if($point > 0){
                    if($point >= $setting->getValueByKey('quantity_product_up_diamond')){
                        $vip = UserVip::Diamond;
                    }elseif($point >= $setting->getValueByKey('quantity_product_up_gold')){
                        $vip = UserVip::Gold;
                    }elseif($point >= $setting->getValueByKey('quantity_product_up_silver')){
                        $vip = UserVip::Silver;
                    }elseif($point >= $setting->getValueByKey('quantity_product_up_bronze')){
                        $vip = UserVip::Bronze;
                    }else{
                        $vip = UserVip::Default;
                    }
                    $user->update([
                        'vip' => $vip
                    ]);
                }
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
