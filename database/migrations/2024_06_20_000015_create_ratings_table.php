<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->nullable();
            $table->string('feedback')->nullable();
            $table->integer('rate')->nullable();
            $table->string('note', 255)->nullable();
            $table->longText('picture')->nullable();
            $table->unsignedBigInteger('lake_id')->nullable();
            $table->unsignedBigInteger('lakechild_id')->nullable();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->timestamps();

            $table->foreign('lakechild_id')->references('id')->on('lake_childs')->onDelete('cascade');
            $table->foreign('lake_id')->references('id')->on('lakes')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });


        // module Ratings
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Ratings',
            'description' => '<p>Quản lý Ratings</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Ratings
        DB::table('permissions')->insert([
            'title' => 'Xem Ratings',
            'name' => 'viewRatings',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Ratings',
            'name' => 'createRatings',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Ratings',
            'name' => 'updateRatings',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Ratings',
            'name' => 'deleteRatings',
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
        Schema::dropIfExists('ratings');
    }
};
