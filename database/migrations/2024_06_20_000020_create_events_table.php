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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->char('code', 50);
            $table->longText('picture')->nullable();
            $table->text('reward')->nullable();
            $table->integer('reward_value')->nullable();
            $table->integer('reward_quantity')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('events_condition')->nullable();
            $table->integer('ccv_point')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('rank_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('lakechild_id')->nullable();

            $table->timestamps();

            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lakechild_id')->references('id')->on('lake_childs')->onDelete('cascade');
        });


        // module Events
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Events',
            'description' => '<p>Quản lý Events</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Events
        DB::table('permissions')->insert([
            'title' => 'Xem Events',
            'name' => 'viewEvents',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Events',
            'name' => 'createEvents',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Events',
            'name' => 'updateEvents',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Events',
            'name' => 'deleteEvents',
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
        Schema::dropIfExists('events');
    }
};
