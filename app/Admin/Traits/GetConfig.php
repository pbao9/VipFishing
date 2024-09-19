<?php

namespace App\Admin\Traits;

trait GetConfig
{
    public function traitGetConfigSidebar() {
        return config('admin_sidebar') ?? [];
    }

    public function traitGetConfigImageDefault() {
        return config('custom.images.default') ?? [];
    }

    public function traitGetConfigDatatableColumns($table) {
        return config('datatables_columns.'.$table) ?? [];
    }
}