<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\Setting\SettingTypeInput;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->truncate();
        DB::table('settings')->insert([
            [
                'setting_key' => 'site_name',
                'setting_name' => 'Tên site',
                'plain_value' => 'Topzone',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'site_logo',
                'setting_name' => 'Logo',
                'plain_value' => '/public/assets/images/logo.png',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'email',
                'setting_name' => 'Email',
                'plain_value' => 'mevivu@gmail.com',
                'type_input' => SettingTypeInput::Email,
                'group' => 1
            ],
            [
                'setting_key' => 'holine',
                'setting_name' => 'Số điện thoại',
                'plain_value' => '0999999999',
                'type_input' => SettingTypeInput::Phone,
                'group' => 1
            ],
            [
                'setting_key' => 'zalo',
                'setting_name' => 'Zalo',
                'plain_value' => '0999999999',
                'type_input' => SettingTypeInput::Phone(),
                'group' => 1
            ],
            [
                'setting_key' => 'bank_name',
                'setting_name' => 'Tên Ngân hàng',
                'plain_value' => 'Vietcombank',
                'type_input' => SettingTypeInput::Text(),
                'group' => 1
            ],
            [
                'setting_key' => 'bank_number',
                'setting_name' => 'Số Tài khoản',
                'plain_value' => '1014298934',
                'type_input' => SettingTypeInput::Number(),
                'group' => 1
            ],
            [
                'setting_key' => 'bank_qrCode',
                'setting_name' => 'Mã QR',
                'plain_value' => '/public/assets/images/logo.png',
                'type_input' => SettingTypeInput::Image(),
                'group' => 1
            ],
            [
                'setting_key' => 'commission_rate',
                'setting_name' => 'Phần trăm hoa hồng đặt đơn',
                'plain_value' => 10,
                'type_input' => SettingTypeInput::Text(),
                'group' => 1
            ],
            [
                'setting_key' => 'reference_fixed',
                'setting_name' => 'Ref Fixed',
                'plain_value' => 40,
                'type_input' => SettingTypeInput::Text(),
                'group' => 1
            ],
            [
                'setting_key' => 'reference_1',
                'setting_name' => 'Ref 1',
                'plain_value' => 30,
                'type_input' => SettingTypeInput::Text(),
                'group' => 1
            ],
            [
                'setting_key' => 'reference_2',
                'setting_name' => 'Ref 2',
                'plain_value' => 30,
                'type_input' => SettingTypeInput::Text(),
                'group' => 1
            ],
            [
                'setting_key' => 'reference_3',
                'setting_name' => 'Ref 3',
                'plain_value' => 10,
                'type_input' => SettingTypeInput::Text(),
                'group' => 1
            ]

        ]);
    }
}
