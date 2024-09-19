<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lakes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('phone', 10)->nullable();
            $table->integer('province_id')->nullable();
            $table->double('latitude', 10, 6)->nullable();
            $table->double('longitude', 10, 6)->nullable();
            $table->text('map')->nullable();
            $table->string('legal_representation', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('car_parking')->nullable();
            $table->boolean('dinner')->nullable();
            $table->boolean('lunch')->nullable();
            $table->boolean('toilet')->nullable();
            $table->text('avatar')->nullable();
            $table->integer('status')->nullable();

            $table->timestamps();
        });


        // module Lakes
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Lakes',
            'description' => '<p>Quản lý Lakes</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Lakes
        DB::table('permissions')->insert([
            'title' => 'Xem Lakes',
            'name' => 'viewLakes',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Lakes',
            'name' => 'createLakes',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Lakes',
            'name' => 'updateLakes',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Lakes',
            'name' => 'deleteLakes',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lakes');
    }
};
