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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->longText('code')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->double('amount')->nullable();
            $table->text('note')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('other_bank')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->text('bank_number')->nullable();
            $table->integer('type')->default(1);
            $table->text('license')->nullable();
            $table->text('admin_license')->nullable();


            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });


        // module Withdraws
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Withdraws',
            'description' => '<p>Quản lý Withdraws</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Withdraws
        DB::table('permissions')->insert([
            'title' => 'Xem Withdraws',
            'name' => 'viewWithdraws',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Withdraws',
            'name' => 'createWithdraws',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Withdraws',
            'name' => 'updateWithdraws',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Withdraws',
            'name' => 'deleteWithdraws',
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
        Schema::dropIfExists('withdraws');
    }
};
