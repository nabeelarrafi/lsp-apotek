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
            CREATE PROCEDURE plus_obat(
                jumlahObat INT,
                idObat INT
            )
                BEGIN
                    UPDATE `obat`
                    SET STOK = STOK + jumlahObat
                    WHERE id = idObat;
                END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS plus_obat');
    }
};
