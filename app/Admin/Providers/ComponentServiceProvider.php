<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('alert', \App\Admin\View\Components\Layout\Alert::class);
        Blade::component('admin-sidebar-left', \App\Admin\View\Components\Layout\SidebarLeft::class);
        Blade::component('admin-item-link-sidebar-left', \App\Admin\View\Components\Link\AdminItemLinkSidebarLeft::class);
        Blade::component('form', \App\Admin\View\Components\Form::class);
        Blade::component('input', \App\Admin\View\Components\Input\Input::class);
        Blade::component('input-checkbox', \App\Admin\View\Components\Input\InputCheckbox::class);
        Blade::component('input-switch', \App\Admin\View\Components\Input\InputSwitch::class);
        Blade::component('input-password', \App\Admin\View\Components\Input\InputPassword::class);
        Blade::component('input-email', \App\Admin\View\Components\Input\InputEmail::class);
        Blade::component('input-phone', \App\Admin\View\Components\Input\InputPhone::class);
        Blade::component('input-number', \App\Admin\View\Components\Input\InputNumber::class);
        // Blade::component('input-datetime', \App\Admin\View\Components\Input\InputDatetime::class);
        Blade::component('input-gallery-ckfinder', \App\Admin\View\Components\Input\InputGalleryCkfinder::class);
        Blade::component('input-image-ckfinder', \App\Admin\View\Components\Input\InputImageCkfinder::class);
        Blade::component('input-file-ckfinder', \App\Admin\View\Components\Input\InputFileCkfinder::class);
        Blade::component('input-pick-address', \App\Admin\View\Components\Input\InputPickAddress::class);
        Blade::component('input-pick-address-multiple', \App\Admin\View\Components\Input\InputPickAddressMultiple::class);
        Blade::component('input-pick-address-user', \App\Admin\View\Components\Input\InputPickAddressUser::class);
        Blade::component('input-pick-end-address', \App\Admin\View\Components\Input\InputPickEndAddress::class);

        // Blade::component('input-video', \App\Admin\View\Components\Input\InputVideo::class);
        Blade::component('textarea', \App\Admin\View\Components\Input\Textarea::class);
        Blade::component('select', \App\Admin\View\Components\Select\Select::class);
        Blade::component('select-option', \App\Admin\View\Components\Select\Option::class);
    }
}
