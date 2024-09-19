<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lakeEvents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('lakechild_id')->nullable();

            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('lakechild_id')->references('id')->on('lake_childs')->onDelete('cascade');
        });


        // module LakeEvents
		$module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý LakeEvents',
            'description' => '<p>Quản lý LakeEvents</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);

		// Permission của module LakeEvents
		DB::table('permissions')->insert([
            'title' => 'Xem LakeEvents',
            'name' => 'viewLakeEvents',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Thêm LakeEvents',
            'name' => 'createLakeEvents',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Sửa LakeEvents',
            'name' => 'updateLakeEvents',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Xóa LakeEvents',
            'name' => 'deleteLakeEvents',
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
        Schema::dropIfExists('lakeEvents');
    }
};
