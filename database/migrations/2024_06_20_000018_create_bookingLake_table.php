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
        Schema::create('bookingLake', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('variationFishs_id')->nullable();
            $table->double('total_price')->nullable();

            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('variationFishs_id')->references('id')->on('variationFishs')->onDelete('cascade');
        });


        // module BookingLake
		$module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý BookingLake',
            'description' => '<p>Quản lý BookingLake</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);

		// Permission của module BookingLake
		DB::table('permissions')->insert([
            'title' => 'Xem BookingLake',
            'name' => 'viewBookingLake',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Thêm BookingLake',
            'name' => 'createBookingLake',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Sửa BookingLake',
            'name' => 'updateBookingLake',
            'guard_name' => 'admin',
            'module_id' => $module_id,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
            'title' => 'Xóa BookingLake',
            'name' => 'deleteBookingLake',
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
        Schema::dropIfExists('bookingLake');
    }
};
