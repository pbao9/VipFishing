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
        // Schema::table('lake_childs', function (Blueprint $table) {
        //     //
        //     $table->unsignedBigInteger('fish_id')->nullable();
        //     $table->foreign('fish_id')->references('id')->on('fish')->onUpdate('NO ACTION')->onDelete('SET NULL');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lake_childs', function (Blueprint $table) {
            //
        });
    }
};
