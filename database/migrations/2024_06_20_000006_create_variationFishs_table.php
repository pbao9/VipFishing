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
        Schema::create('variationFishs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fish_id')->nullable();
            $table->float('fish_density')->nullable();
            $table->integer('fish_price')->nullable();

            $table->timestamps();

            $table->foreign('fish_id')->references('id')->on('fishs')->onDelete('cascade');
        });


        // module VariationFishs
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý VariationFishs',
            'description' => '<p>Quản lý VariationFishs</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module VariationFishs
        DB::table('permissions')->insert([
            'title' => 'Xem VariationFishs',
            'name' => 'viewVariationFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm VariationFishs',
            'name' => 'createVariationFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa VariationFishs',
            'name' => 'updateVariationFishs',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa VariationFishs',
            'name' => 'deleteVariationFishs',
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
        Schema::dropIfExists('variationFishs');
    }
};
