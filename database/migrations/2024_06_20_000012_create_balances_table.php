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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->double('total_balance')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        // module Balances
		$module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Balances',
            'description' => '<p>Quản lý Balances</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);

		// Permission của module Balances
		DB::table('permissions')->insert([
            'title' => 'Xem Balances',
            'name' => 'viewBalances',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Thêm Balances',
            'name' => 'createBalances',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Sửa Balances',
            'name' => 'updateBalances',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Xóa Balances',
            'name' => 'deleteBalances',
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
        Schema::dropIfExists('balances');
    }
};
