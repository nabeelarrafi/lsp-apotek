<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared('
            CREATE TRIGGER total_penjualan_delete 
            AFTER DELETE
            ON `detail_penjualan` FOR EACH ROW
            BEGIN
                UPDATE `penjualan`
                SET total_jual = (SELECT SUM(jumlah_jual) FROM `detail_penjualan` WHERE id_penjualan = OLD.id_penjualan)
                WHERE id = OLD.id_penjualan;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP TRIGGER `total_penjualan_delete`');
    }
};
