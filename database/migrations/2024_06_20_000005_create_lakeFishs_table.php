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
        Schema::create('lakeFishs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lakechild_id')->nullable();
            $table->unsignedBigInteger('fish_id')->nullable();

            $table->timestamps();
            $table->foreign('lakechild_id')->references('id')->on('lake_childs')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign('fish_id')->references('id')->on('fishs')->onUpdate('NO ACTION')->onDelete('SET NULL');


        });



        // module LakeFishs
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý LakeFishs',
            'description' => '<p>Quản lý LakeFishs</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module LakeFishs
        DB::table('permissions')->insert([
            'title' => 'Xem LakeFishs',
            'name' => 'viewLakeFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm LakeFishs',
            'name' => 'createLakeFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa LakeFishs',
            'name' => 'updateLakeFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa LakeFishs',
            'name' => 'deleteLakeFishs',
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
        Schema::dropIfExists('lakeFishs');
    }
};
