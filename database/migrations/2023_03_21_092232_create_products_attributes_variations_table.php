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
        Schema::create('products_attributes_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('product_attribute_id');
            $table->unsignedBigInteger('attribute_variation_id');
            $table->primary(['product_attribute_id', 'attribute_variation_id']);

            $table->foreign('product_attribute_id')->references('id')->on('products_attributes')->onDelete('cascade');
            $table->foreign('attribute_variation_id')->references('id')->on('attributes_variations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('products_attributes_variations', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['product_attribute_id']);
            $table->dropForeign(['attribute_variation_id']);
        });
        Schema::dropIfExists('products_attributes_variations');
    }
};
