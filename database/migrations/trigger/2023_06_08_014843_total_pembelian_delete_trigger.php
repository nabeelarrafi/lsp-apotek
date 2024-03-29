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
            CREATE TRIGGER total_pembelian_delete
            AFTER DELETE
            ON `detail_pembelian` FOR EACH ROW
            BEGIN
                CALL sum_total_pembelian(OLD.id_pembelian);
                CALL minus_obat(OLD.jumlah_beli, OLD.id_obat);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP TRIGGER `total_pembelian_delete`');
    }
};
