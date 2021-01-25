<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_admin', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id');

            $table->foreign('admin_id')
                ->references('id')->on('admin')
                ->onUpdate('cascade')->onDelete('cascade');

            // Data Pribadi
            $table->string('nama', 50);
            $table->enum('jen_kel', ['l', 'p'])->comment('l => Laki-laki, p => Perempuan')->nullable();
            $table->string('tgl_lahir', 10)->nullable();
            $table->unsignedSmallInteger('kabkota_lahir_id')->nullable();

            $table->foreign('kabkota_lahir_id')
                ->references('id')->on('kabkota')
                ->onUpdate('cascade')->onDelete('set null');

            // Alamat
            $table->text('alamat')->nullable();
            $table->string('rt', 4)->nullable();
            $table->string('rw', 4)->nullable();
            $table->unsignedSmallInteger('provinsi_id')->nullable();
            $table->unsignedSmallInteger('kabkota_id')->nullable();
            $table->unsignedInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('desa_id')->nullable();
            $table->char('kode_pos')->nullable();

            $table->foreign('provinsi_id')
                ->references('id')->on('provinsi')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('kabkota_id')
                ->references('id')->on('kabkota')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('kecamatan_id')
                ->references('id')->on('kecamatan')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('desa_id')
                ->references('id')->on('desa')
                ->onUpdate('cascade')->onDelete('set null');

            // Kontak
            $table->char('telp', 20)->nullable();
            $table->char('no_hp', 20)->nullable();
            $table->char('kontak_lain', 20)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil_admin');
    }
}
