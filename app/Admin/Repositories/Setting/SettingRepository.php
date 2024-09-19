<?php

namespace App\Admin\Repositories\Setting;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\{Cache, DB};

class SettingRepository extends EloquentRepository implements SettingRepositoryInterface
{
    public function getModel()
    {
        return Setting::class;
    }
    public function getByGroup(array $group)
    {
        $this->instance = $this->model->whereIn('group', $group)->get();
        return $this->instance;
    }


    public function getAllBySettingGroup($settingGroup)
    {
        $this->instance = $this->model->pluck('plain_value', 'setting_key');
        return $this->getInstance();
    }


    public function getValueByKey($key)
    {
        $this->getAllBySettingGroup($key);
        return $this->instance[$key] ?? '';
    }

    public function updateMultipleRecord(array $data)
    {

        Cache::forget(Setting::CACHE_KEY_GET_ALL);

        $query = "UPDATE settings SET plain_value = CASE setting_key ";
        foreach ($data as $key => $value) {
            $query .= "WHEN '{$key}' THEN '{$value}' ";
        }
        $query .= "END WHERE setting_key IN ('" . implode("', '", array_keys($data)) . "')";
        return DB::update($query);
    }
}
