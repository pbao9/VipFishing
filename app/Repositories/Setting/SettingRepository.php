<?php
namespace App\Repositories\Setting;

use App\Admin\Repositories\EloquentRepository;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingRepository extends EloquentRepository implements SettingRepositoryInterface
{
    protected $select = [];
    public function getModel(){
        return Setting::class;
    }

    public function getAll(){
        $this->instance = Cache::rememberForever(Setting::CACHE_KEY_GET_ALL, function () {
            return $this->model->pluck('plain_value', 'setting_key');
        });
        return $this;
    }
    public function getValueByKey($key)
    {
        return $this->instance[$key] ?? null;
    }

    public function findOrFail($id){
        $this->instance = $this->model->findOrFail($id);
        return $this->instance;
    }
}