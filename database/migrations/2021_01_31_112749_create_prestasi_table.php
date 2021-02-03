<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('semester_id');
            $table->string('nama', 50);
            $table->enum('status', ['Tunggal', 'Ganda', 'Kelompok']);
            $table->string('tahun', 4)->nullable();
            $table->string('file_upload', 100)->nullable();
            $table->timestamps();

            $table->foreign('semester_id')
                ->references('id')->on('semester')
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
        Schema::dropIfExists('prestasi');
    }
}
