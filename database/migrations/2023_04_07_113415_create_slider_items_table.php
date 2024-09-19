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
        Schema::create('slider_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id');
            $table->string('title');
            $table->text('link');
            $table->tinyInteger('position');
            $table->text('image');
            $table->text('mobile_image');
            $table->timestamps();
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('slider_items', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['slider_id']);
        });
        Schema::dropIfExists('slider_items');
    }
};
