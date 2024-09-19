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
        Schema::create('closeLakes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lakechild_id')->nullable();
            $table->dateTime('close_date')->nullable();
            $table->dateTime('open_date')->nullable();
            $table->integer('close_days')->nullable();
            $table->integer('canceled_bookings')->nullable();
            $table->double('total_refund_amount')->nullable();
            $table->double('compensation_amount')->nullable();
            $table->timestamps();

            $table->foreign('lakeChild_id')->references('id')->on('lake_childs')->onDelete('cascade');
        });

        // module CloseLake
		$module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Hồ đóng cửa',
            'description' => '<p>Quản lý Hồ đóng cửa</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);

		// Permission của module CloseLake
		DB::table('permissions')->insert([
            'title' => 'Xem CloseLake',
            'name' => 'viewCloseLake',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Thêm CloseLake',
            'name' => 'createCloseLake',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Sửa CloseLake',
            'name' => 'updateCloseLake',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Xóa CloseLake',
            'name' => 'deleteCloseLake',
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
        Schema::dropIfExists('close_lake');
    }
};
