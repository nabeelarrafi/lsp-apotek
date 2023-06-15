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
        CREATE TRIGGER total_penjualan 
        AFTER INSERT
        ON `detail_penjualan` FOR EACH ROW
        BEGIN
            IF NEW.jumlah_jual IS NOT NULL THEN
                UPDATE `penjualan`
                SET total_jual = (SELECT SUM(jumlah_jual) FROM `detail_penjualan` WHERE id_penjualan = NEW.id_penjualan)
                WHERE id = NEW.id_penjualan;
            END IF;
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP TRIGGER `total_penjualan`');
    }
};
