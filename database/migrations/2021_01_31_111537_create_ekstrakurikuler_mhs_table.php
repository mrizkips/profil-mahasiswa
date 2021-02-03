<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEkstrakurikulerMhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekstrakurikuler_mhs', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('ekstrakurikuler_id');
            $table->unsignedBigInteger('semester_id');
            $table->enum('jabatan', ['Anggota', 'Sekretaris', 'Ketua', 'Wakil Ketua']);
            $table->timestamps();

            $table->foreign('ekstrakurikuler_id')
                ->references('id')->on('ekstrakurikuler')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('ekstrakurikuler_mhs');
    }
}
