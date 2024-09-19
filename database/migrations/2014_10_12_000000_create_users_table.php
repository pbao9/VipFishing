<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('code', 50)->unique();
            $table->string('fullname')->nullable();
            $table->string('nickname')->nullable();
            $table->char('email', 100)->unique();
            $table->char('phone', 20)->unique();
            $table->text('address')->nullable();
            $table->text('avatar')->nullable();
            $table->tinyInteger('gender')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token_get_password')->nullable();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('rank_id')->default(1);
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->text('bank_number')->nullable();
            $table->double('discount_user')->default(0);
            $table->integer('ref_status')->default(0);
            // Các cột giới thiệu
            $table->char('RF')->nullable();
            $table->char('RF1')->nullable();
            $table->char('RF2')->nullable();
            $table->char('RF3')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
