<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('semester_id');
            $table->string('nama', 50);
            $table->string('penyelenggara', 50);
            $table->enum('tingkat', ['Lokal', 'Nasional', 'Internasional']);
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
        Schema::dropIfExists('kegiatan');
    }
}
