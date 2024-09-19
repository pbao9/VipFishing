<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('compensations', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->nullable();
            $table->integer('type')->default(3);
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        // module Compensations
		$module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Compensations',
            'description' => '<p>Quản lý Compensations</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);

		// Permission của module Compensations
		DB::table('permissions')->insert([
            'title' => 'Xem Compensations',
            'name' => 'viewCompensations',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Thêm Compensations',
            'name' => 'createCompensations',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Sửa Compensations',
            'name' => 'updateCompensations',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Xóa Compensations',
            'name' => 'deleteCompensations',
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
        Schema::dropIfExists('compensations');
    }
};
