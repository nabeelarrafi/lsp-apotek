<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared('
            CREATE PROCEDURE sum_total_penjualan(idPenjualan INT)
                BEGIN
                    UPDATE `penjualan`
                    SET total_jual = ifnull((SELECT SUM(jumlah_jual) FROM `detail_penjualan` WHERE id_penjualan = idPenjualan),0)
                    WHERE id = idPenjualan;
                END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS sum_total_penjualan');
    }
};
