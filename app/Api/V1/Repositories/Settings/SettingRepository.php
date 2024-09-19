<?php

namespace App\Api\V1\Repositories\Settings;

use App\Admin\Repositories\Setting\SettingRepository as AdminSettingsRepository;
use App\Models\Setting;

class SettingRepository extends AdminSettingsRepository implements SettingRepositoryInterface
{
    public function getModel()
    {
        return Setting::class;
    }
}
