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
        Schema::create('fishs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->timestamps();
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('set null');
        });


        // module Fishs
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Fishs',
            'description' => '<p>Quản lý Fishs</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Fishs
        DB::table('permissions')->insert([
            'title' => 'Xem Fishs',
            'name' => 'viewFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Fishs',
            'name' => 'createFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Fishs',
            'name' => 'updateFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Fishs',
            'name' => 'deleteFishs',
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
        Schema::table('fishs', function (Blueprint $table) {
            $table->dropForeign(['province_code']);
        });
        Schema::dropIfExists('fishs');
    }
};
