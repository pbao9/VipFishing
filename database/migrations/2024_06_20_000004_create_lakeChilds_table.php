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
        Schema::create('lake_childs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(); //tên hồ
            $table->text('description')->nullable(); // mô tả
            $table->integer('area')->nullable(); // diện tích hồ
            $table->integer('fish_volume')->nullable(); // khối lượng cá
            $table->float('fish_density')->nullable(); // mật độ cá
            $table->integer('fishing_rod_limit')->nullable(); // giới hạn cần
            $table->time('open_time')->nullable(); // thi gian m cửa
            $table->time('close_time')->nullable(); // tời gian đóng cửa
            $table->json('open_day')->nullable(); // ngày mở cửa
            $table->integer('status')->nullable(); // trạng thái
            $table->integer('compensation')->nullable(); // đền bùu %
            $table->integer('collect_fish_price')->nullable(); //giá thu lại
            $table->integer('collect_fish_type')->nullable();  // thu muia lại cá kg hoặc con
            $table->integer('type')->nullable(); // loajii hồ câu
            $table->integer('slot')->nullable(); // số chỗ câu
            $table->unsignedBigInteger('lake_id')->nullable();
            $table->unsignedBigInteger('fish_id')->nullable();
            $table->timestamps();
            $table->foreign('lake_id')->references('id')->on('lakes')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign('fish_id')->references('id')->on('fishs')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });


        // module Lakechilds
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Lakechilds',
            'description' => '<p>Quản lý Lakechilds</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Lakechilds
        DB::table('permissions')->insert([
            'title' => 'Xem Lakechilds',
            'name' => 'viewLakechilds',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Lakechilds',
            'name' => 'createLakechilds',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Lakechilds',
            'name' => 'updateLakechilds',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Lakechilds',
            'name' => 'deleteLakechilds',
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
        Schema::dropIfExists('lakechilds');
    }
};
