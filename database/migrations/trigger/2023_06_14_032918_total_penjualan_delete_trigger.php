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
                CALL sum_total_penjualan(OLD.id_penjualan);
                CALL plus_obat(OLD.jumlah_jual, OLD.id_obat);
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
