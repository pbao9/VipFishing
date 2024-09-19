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
        Schema::create('lake_childs_fishing_set', function (Blueprint $table) {
            $table->unsignedBigInteger('fishingSet_id');
            $table->unsignedBigInteger('lakeChild_id');

            $table->primary(['fishingSet_id', 'lakeChild_id']);

            $table->foreign('fishingSet_id')->references('id')->on('fishingSet')->onDelete('cascade');
            $table->foreign('lakeChild_id')->references('id')->on('lake_childs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return
     */
    public function down()
    {
        Schema::table('lake_childs_fishing_set', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['fishingSet_id']);
            $table->dropForeign(['lakeChild_id']);
        });
        Schema::dropIfExists('lake_childs_fishing_set');
    }
};
