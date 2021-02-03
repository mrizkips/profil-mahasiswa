<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->enum('tipe', ['Genap', 'Ganjil', 'Antara']);
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedSmallInteger('tahun_akademik_id');
            $table->timestamps();

            $table->foreign('mahasiswa_id')
                ->references('id')->on('mahasiswa')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('tahun_akademik_id')
                ->references('id')->on('tahun_akademik')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semester');
    }
}
