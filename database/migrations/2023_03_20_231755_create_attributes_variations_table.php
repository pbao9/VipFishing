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
        Schema::create('attributes_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->string('name');
            $table->string('slug');
            $table->tinyInteger('position')->default(0);
            $table->text('meta_value')->nullable();
            $table->text('desc')->nullable();
            $table->timestamps();
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('attributes_variations', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['attribute_id']);
        });
        Schema::dropIfExists('attributes_variations');
    }
};
