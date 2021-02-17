<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAktifToTahunAkademikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tahun_akademik', function (Blueprint $table) {
            $table->enum('aktif', ['0', '1'])->default('0')->comment('0 => False, 1 => True');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tahun_akademik', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
    }
}
