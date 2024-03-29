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
            CREATE TRIGGER total_pembelian
            AFTER INSERT
            ON `detail_pembelian` FOR EACH ROW
            BEGIN
                IF NEW.jumlah_beli IS NOT NULL THEN
                    CALL sum_total_pembelian(NEW.id_pembelian);
                    CALL plus_obat(NEW.jumlah_beli, NEW.id_obat);
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
        DB::unprepared('DROP TRIGGER `total_pembelian`');
    }
};
