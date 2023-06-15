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
            CREATE PROCEDURE sum_total_pembelian(idPembelian INT)
                BEGIN
                    UPDATE `pembelian`
                    SET total_beli = ifnull((SELECT SUM(jumlah_beli) FROM `detail_pembelian` WHERE id_pembelian = idPembelian), 0)
                    WHERE id = idPembelian;
                END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS sum_total_pembelian');
    }
};
