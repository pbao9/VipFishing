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
        // Schema::table('variationFishs', function (Blueprint $table) {
        //     //
        //     $table->integer('ticket_price')->storedAs('	fish_density * fish_price');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variationFishs', function (Blueprint $table) {
            //
        });
    }
};
