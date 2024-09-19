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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('_lft');
            $table->integer('_rgt');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('avatar')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('NO ACTION')->onDelete('SET NULL'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('categories', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('categories');
    }
};
