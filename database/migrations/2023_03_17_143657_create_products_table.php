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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->string('name');
            $table->string('slug')->unique();
            $table->double('price')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('promotion_price')->nullable();
            $table->string('sku')->nullable();
            $table->boolean('manager_stock')->default(false);
            $table->integer('qty')->nullable();
            $table->boolean('in_stock')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_user_discount')->default(false);
            $table->boolean('is_earning_point')->default(false);
            $table->text('avatar')->nullable();
            $table->longText('gallery')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('informations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
