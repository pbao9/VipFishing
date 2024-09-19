<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->nullable();
            $table->integer('hcv_point')->nullable();
            $table->integer('ccv_point')->nullable();
            $table->integer('round')->nullable();
            $table->integer('awards')->nullable();
            $table->integer('lake')->nullable();
            $table->integer('province')->nullable();
            $table->integer('stauts_comission')->nullable();
            $table->integer('rating')->nullable();
            
            $table->timestamps();
        });
        
        
        // module Ranks		
		$module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Ranks',
            'description' => '<p>Quản lý Ranks</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		// Permission của module Ranks
		DB::table('permissions')->insert([
            'title' => 'Xem Ranks',
            'name' => 'viewRanks',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
		DB::table('permissions')->insert([
            'title' => 'Thêm Ranks',
            'name' => 'createRanks',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
		DB::table('permissions')->insert([
            'title' => 'Sửa Ranks',
            'name' => 'updateRanks',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
		DB::table('permissions')->insert([
            'title' => 'Xóa Ranks',
            'name' => 'deleteRanks',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
        //Insert data sẵn cho người dùng

        DB::table('ranks')->insert([
            [
                'id' => 1,
                'title' => 'Cần Thủ Thường',
                'hcv_point' => 1,
                'ccv_point' => 10,
                'round' => 0,
                'awards' => 0,
                'lake' => 0,
                'province' => 0,
                'stauts_comission' => 2,
                'rating' => 0,
            ],
            [
                'id' => 2,
                'title' => 'Chuẩn Cần Thủ',
                'hcv_point' => 2,
                'ccv_point' => 20,
                'round' => 3,
                'awards' => 0,
                'lake' => 1,
                'province' => 0,
                'stauts_comission' => 1,
                'rating' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Đài Sư Cấp 3',
                'hcv_point' => 10,
                'ccv_point' => 500,
                'round' => 50,
                'awards' => 10,
                'lake' => 10,
                'province' => 3,
                'stauts_comission' => 1,
                'rating' => 10,
            ],
            [
                'id' => 4,
                'title' => 'Đài Sư Cấp 2',
                'hcv_point' => 20,
                'ccv_point' => 1500,
                'round' => 100,
                'awards' => 50,
                'lake' => 25,
                'province' => 10,
                'stauts_comission' => 1,
                'rating' => 50,
            ],
            [
                'id' => 5,
                'title' => 'Đài Sư Cấp 1',
                'hcv_point' => 50,
                'ccv_point' => 5000,
                'round' => 250,
                'awards' => 100,
                'lake' => 50,
                'province' => 25,
                'stauts_comission' => 1,
                'rating' => 100,
            ],
            [
                'id' => 6,
                'title' => 'Đặc Cấp Đài Sư',
                'hcv_point' => 100,
                'ccv_point' => 10000,
                'round' => 500,
                'awards' => 200,
                'lake' => 100,
                'province' => 50,
                'stauts_comission' => 1,
                'rating' => 200,
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
        Schema::dropIfExists('ranks');
    }
};
