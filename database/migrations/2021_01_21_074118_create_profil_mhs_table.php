<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilMhsTable extends Migration
{
    /**
     * Schema table name to migrate.
     * @var string
     */
    public $tableName = 'profil_mhs';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id');

            $table->foreign('mahasiswa_id')
                ->references('id')->on('mahasiswa')
                ->onUpdate('cascade')->onDelete('cascade');

            // Data Pribadi
            $table->string('nama', 50);
            $table->enum('jen_kel', ['l', 'p'])->comment('l => Laki-laki, p => Perempuan')->nullable();
            $table->string('tgl_lahir', 10)->nullable();
            $table->unsignedSmallInteger('kabkota_lahir_id')->nullable();
            $table->unsignedSmallInteger('pekerjaan_id')->nullable();

            $table->foreign('kabkota_lahir_id')
                ->references('id')->on('kabkota')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('pekerjaan_id')
                ->references('id')->on('pekerjaan')
                ->onUpdate('cascade')->onDelete('set null');

            // Status dan Pilihan
            $table->string('asal_sekolah', 50)->nullable();
            $table->string('jurusan_asal', 50)->nullable();
            $table->enum('status_mhs', ['Baru', 'Pindahan'])->nullable();
            $table->unsignedSmallInteger('jurusan_id')->nullable();
            $table->string('no_test', 8)->nullable();
            $table->string('thn_masuk', 4)->nullable();
            $table->unsignedSmallInteger('asal_pemasaran_id')->nullable();

            $table->foreign('jurusan_id')
                ->references('id')->on('jurusan')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('asal_pemasaran_id')
                ->references('id')->on('asal_pemasaran')
                ->onUpdate('cascade')->onDelete('set null');

            // Alamat
            $table->text('alamat')->nullable();
            $table->char('rt', 4)->nullable();
            $table->char('rw', 4)->nullable();
            $table->unsignedSmallInteger('provinsi_id')->nullable();
            $table->unsignedSmallInteger('kabkota_id')->nullable();
            $table->unsignedInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('desa_id')->nullable();
            $table->char('kode_pos', 10)->nullable();

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
            $table->string('email', 50)->nullable();
            $table->string('website', 50)->nullable();

            // Wali
            $table->string('nama_ayah', 50)->nullable();
            $table->string('nama_ibu', 50)->nullable();
            $table->unsignedSmallInteger('pekerjaan_ayah_id')->nullable();
            $table->unsignedSmallInteger('pekerjaan_ibu_id')->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('rt_wali', 4)->nullable();
            $table->string('rw_wali', 4)->nullable();
            $table->unsignedSmallInteger('provinsi_wali_id')->nullable();
            $table->unsignedSmallInteger('kabkota_wali_id')->nullable();
            $table->unsignedInteger('kecamatan_wali_id')->nullable();
            $table->unsignedBigInteger('desa_wali_id')->nullable();
            $table->char('kode_pos_wali', 10)->nullable();
            $table->char('telp_wali', 20)->nullable();
            $table->char('no_hp_wali', 20)->nullable();
            $table->char('kontak_lain_wali', 20)->nullable();

            $table->foreign('pekerjaan_ayah_id')
                ->references('id')->on('pekerjaan')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('pekerjaan_ibu_id')
                ->references('id')->on('pekerjaan')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('provinsi_wali_id')
                ->references('id')->on('provinsi')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('kabkota_wali_id')
                ->references('id')->on('kabkota')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('kecamatan_wali_id')
                ->references('id')->on('kecamatan')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('desa_wali_id')
                ->references('id')->on('desa')
                ->onUpdate('cascade')->onDelete('set null');

            // Persyaratan
            $table->string('pas_foto', 100)->nullable();
            // $table->string('fc_raport', 100)->nullable();
            // $table->string('fc_ijazah', 100)->nullable();
            // $table->string('surat_ket_pindah', 100)->nullable();
            // $table->string('fc_transkrip_pt', 100)->nullable();
            // $table->string('fc_ijazah_pt', 100)->nullable();

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
        Schema::dropIfExists($this->tableName);
    }
}
