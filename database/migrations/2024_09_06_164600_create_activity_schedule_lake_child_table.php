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
        Schema::create('activity_schedule_lake_child', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lake_child_id')->nullable();
            $table->date('activity_date')->nullable();
            $table->timestamps();

            $table->foreign('lake_child_id')->references('id')->on('lake_childs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_schedule_lake_child');
    }
};
