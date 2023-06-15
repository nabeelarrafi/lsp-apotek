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
                    CALL sum_total_penjualan(NEW.id_penjualan);
                    CALL minus_obat(NEW.jumlah_jual, NEW.id_obat);
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
