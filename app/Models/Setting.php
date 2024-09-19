<?php

namespace App\Models;

use App\Enums\Setting\{SettingTypeInput, SettingGroup};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    const CACHE_KEY_GET_ALL = 'cache_settings';

    protected $guarded = [];

    protected $casts = [
        'type_input' => SettingTypeInput::class,
        'group' => SettingGroup::class,
    ];

    public function getNameComponentTypeInput(){
        if($this->type_input == SettingTypeInput::Text()){
            return 'input';
        }elseif($this->type_input == SettingTypeInput::Number()){
            return 'input-number';
        }elseif($this->type_input == SettingTypeInput::Image()){
            return 'input-image-ckfinder';
        }elseif($this->type_input == SettingTypeInput::Email()){
            return 'input-email';
        }elseif($this->type_input == SettingTypeInput::Phone()){
            return 'input-phone';
        }else{
            return 'input';
        }
    }
}
