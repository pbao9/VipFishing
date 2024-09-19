<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishingSet', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            $table->time('time_checkin')->nullable();
            $table->integer('duration')->nullable();

            $table->timestamps();
        });


        // module FishingSet
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý FishingSet',
            'description' => '<p>Quản lý FishingSet</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module FishingSet
        DB::table('permissions')->insert([
            'title' => 'Xem FishingSet',
            'name' => 'viewFishingSet',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm FishingSet',
            'name' => 'createFishingSet',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa FishingSet',
            'name' => 'updateFishingSet',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa FishingSet',
            'name' => 'deleteFishingSet',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('fishingSet')->insert([
            [
                "id" => "1",
                "title" => "Suất sáng",
                "time_start" => "07:00",
                "time_end" => "12:00",
                'time_checkin' => "07:00",
                "duration" => "5",
            ],
            [
                "id" => "2",
                "title" => "Suất chiều",
                "time_start" => "12:00",
                "time_end" => "17:00",
                'time_checkin' => "12:00",
                "duration" => "5",
            ],
            [
                "id" => "3",
                "title" => "Suất ngày",
                "time_start" => "07:00",
                "time_end" => "17:00",
                'time_checkin' => "07:00",
                "duration" => "10",
            ],
            [
                "id" => "4",
                "title" => "Suất tự do",
                "time_start" => null,
                "time_end" => null,
                'time_checkin' => null,
                "duration" => null,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fishingSet');
    }
};
