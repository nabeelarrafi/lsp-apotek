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
            CREATE TRIGGER total_penjualan_update
            AFTER UPDATE
            ON `detail_penjualan` FOR EACH ROW
            BEGIN
                IF NEW.jumlah_jual IS NOT NULL THEN
                    IF NEW.id_penjualan <> OLD.id_penjualan THEN
                        CALL sum_total_penjualan(OLD.id_penjualan);
                        CALL minus_obat(OLD.jumlah_jual, OLD.id_obat);
                    END IF;
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
        DB::unprepared('DROP TRIGGER `total_penjualan_update`');
    }
};
