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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('customer_fullname');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->text('shipping_address')->nullable();
            $table->double('sub_total');
            $table->tinyInteger('shipping_method')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->double('discount');
            $table->double('total');
            $table->tinyInteger('payment_method');
            $table->string('payment_code')->nullable();
            $table->tinyInteger('status');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
