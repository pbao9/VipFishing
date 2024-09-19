<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('bookingLake', function (Blueprint $table) {
        //     // Thêm cột total_price
        //     $table->decimal('total_price', 10, 2)->nullable();
        // });

        // // Thêm trigger
        // DB::unprepared('
        //     CREATE TRIGGER calculate_total_price BEFORE INSERT ON bookingLake
        //     FOR EACH ROW
        //     BEGIN
        //         DECLARE v_duration INT;
        //         DECLARE v_ticket_price DECIMAL(10, 2);

        //         SELECT duration INTO v_duration
        //         FROM fishingSet
        //         WHERE id = NEW.booking_id;

        //         SELECT ticket_price INTO v_ticket_price
        //         FROM variationFishs
        //         WHERE id = NEW.variationFishs_id;

        //         SET NEW.total_price = v_duration * v_ticket_price;
        //     END
        // ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookingLake', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });

        DB::unprepared('DROP TRIGGER IF EXISTS calculate_total_price');
    }
};
