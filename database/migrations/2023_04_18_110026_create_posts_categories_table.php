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
        Schema::create('posts_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('_lft');
            $table->integer('_rgt');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('position')->default(0);
            $table->tinyInteger('status');
            $table->longText('desc')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('posts_categories')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('posts_categories', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('posts_categories');
    }
};
