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
        Schema::create('fishing_rating', function (Blueprint $table) {
            $table->id();
            $table->string('type_fishing_rating');
            $table->timestamps();
        });
        // module Fishing Ratings
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Xuất Câu',
            'description' => '<p>Chức năng thêm, xoá, sửa xuất câu</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
        // Permission của module Fishing Ratings
        DB::table('permissions')->insert([
            'title' => 'Xem Xuất Câu',
            'name' => 'viewFishingRating',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
		DB::table('permissions')->insert([
            'title' => 'Thêm Xuất Câu',
            'name' => 'createFishingRating',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
		DB::table('permissions')->insert([
            'title' => 'Sửa Xuất Câu',
            'name' => 'updateFishingRating',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
		DB::table('permissions')->insert([
            'title' => 'Xóa Xuất Câu',
            'name' => 'deleteFishingRating',
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
        Schema::dropIfExists('fishing_rating');
    }
};
