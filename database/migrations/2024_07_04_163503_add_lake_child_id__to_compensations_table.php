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
        // Schema::table('compensations', function (Blueprint $table) {
        //     //
        //     $table->unsignedBigInteger('lake_child_id')->nullable();
        //     $table->foreign('lake_child_id')->references('id')->on('lake_childs')->onUpdate('NO ACTION')->onDelete('SET NULL');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compensations', function (Blueprint $table) {
            //
        });
    }
};
