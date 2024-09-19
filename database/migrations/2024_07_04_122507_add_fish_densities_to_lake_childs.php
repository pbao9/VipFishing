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
        // Schema::table('lake_childs', function (Blueprint $table) {
        //     $table->integer('fish_densities')->storedAs('fish_volume / area');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lake_childs', function (Blueprint $table) {
            $table->dropColumn('fish_densities');
        });
    }
};
