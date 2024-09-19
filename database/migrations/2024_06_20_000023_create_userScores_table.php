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
        Schema::create('userScores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->float('total_ccv')->nullable()->default(0);
            $table->integer('total_round')->nullable()->default(0);
            $table->integer('total_hcv')->nullable()->default(0);
            $table->integer('total_awards')->nullable()->default(0);
            $table->integer('total_lake')->nullable()->default(0);
            $table->integer('total_province')->nullable()->default(0);
            $table->integer('total_rating')->nullable()->default(0);

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        // module UserScores
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý UserScores',
            'description' => '<p>Quản lý UserScores</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module UserScores
        DB::table('permissions')->insert([
            'title' => 'Xem UserScores',
            'name' => 'viewUserScores',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm UserScores',
            'name' => 'createUserScores',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa UserScores',
            'name' => 'updateUserScores',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa UserScores',
            'name' => 'deleteUserScores',
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
        Schema::dropIfExists('userScores');
    }
};
