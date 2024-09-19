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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->char('booking_code')->nullable()->unique();
            $table->dateTime('fishing_date')->nullable();
            $table->integer('position')->nullable();
            $table->double('total_price')->nullable();
            $table->integer('status')->nullable();
            // $table->integer('fishing_status')->nullable();
            // $table->integer('payment_status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('lakeChild_id')->nullable();
            $table->unsignedBigInteger('fishingset_id')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lakeChild_id')->references('id')->on('lake_childs')->onDelete('cascade');
            $table->foreign('fishingset_id')->references('id')->on('fishingSet')->onDelete('cascade');
        });


        // module Bookings
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Bookings',
            'description' => '<p>Quản lý Bookings</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Bookings
        DB::table('permissions')->insert([
            'title' => 'Xem Bookings',
            'name' => 'viewBookings',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Bookings',
            'name' => 'createBookings',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Bookings',
            'name' => 'updateBookings',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Bookings',
            'name' => 'deleteBookings',
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
        Schema::dropIfExists('bookings');
    }
};
