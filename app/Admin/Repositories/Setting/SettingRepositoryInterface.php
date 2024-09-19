<?php

namespace App\Admin\Repositories\Setting;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface SettingRepositoryInterface extends EloquentRepositoryInterface
{
    public function getByGroup(array $group);
    public function updateMultipleRecord(array $data);
    public function getAllBySettingGroup($settingGroup);
    public function getValueByKey($key);
}
