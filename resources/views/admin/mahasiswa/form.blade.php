@extends('layouts.base')

@section('title', isset($mahasiswa) ? 'Edit Mahasiswa - '.config('app.name') : 'Tambah Mahasiswa - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a></li>
    <li class="breadcrumb-item active">{{ isset($mahasiswa) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-people">
                </i>&nbsp;Mahasiswa</strong>&nbsp;<small>Form {{ isset($mahasiswa) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($mahasiswa) ? route('admin.mahasiswa.update', $mahasiswa->id) : route('admin.mahasiswa.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($mahasiswa) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Status dan Pilihan</strong></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_mhs" class="d-block"><strong>Status Mahasiswa</strong></label>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="status_mhs" id="status_mhs1" class="form-check-input" value="{{ config('constants.forms.mahasiswa.status_mhs.baru') }}">
                                                <label for="status_mhs1" class="form-check-label">Baru</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="status_mhs" id="status_mhs2" class="form-check-input" value="{{ config('constants.forms.mahasiswa.status_mhs.pindahan') }}">
                                                <label for="status_mhs2" class="form-check-label">Pindahan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="asal_sekolah"><strong>Asal Sekolah / PT</strong></label>
                                            <div class="col-md-9">
                                                <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" placeholder="Masukkan asal sekolah">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="jurusan_asal"><strong>Jurusan</strong></label>
                                            <div class="col-md-9">
                                                <input type="text" name="jurusan_asal" id="jurusan_asal" class="form-control" placeholder="Masukkan jurusan asal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label for="jurusan_id" class="col-md-auto col-form-label"><strong>Jurusan Pilihan</strong></label>
                                            <div class="col-md col-form-label">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="jurusan_id" id="jurusan_id1" class="form-check-input" value="">
                                                    <label for="jurusan_id1" class="form-check-label">Teknik Informatika</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="jurusan_id" id="jurusan_id2" class="form-check-input" value="">
                                                    <label for="jurusan_id2" class="form-check-label">Sistem Informasi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label for="no_test" class="col-md-4 col-form-label"><strong>Nomor Test Masuk</strong></label>
                                            <div class="col-md-8">
                                                <input type="number" name="no_test" id="no_test" class="form-control" placeholder="Masukkan nomor test">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label for="thn_masuk" class="col-md-auto col-form-label"><strong>Tahun Masuk</strong></label>
                                            <div class="col-md">
                                                <input type="number" name="thn_masuk" id="thn_masuk" class="form-control" placeholder="Masukkan tahun masuk">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label for="semester" class="col-md-auto col-form-label"><strong>Semester</strong></label>
                                            <div class="col-md">
                                                <input type="number" name="semester" id="semester" class="form-control" placeholder="Masukkan semester">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Biodata Mahasiswa</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md col-form-label"><strong>Nama Lengkap</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jen_kel" class="col-md col-form-label"><strong>Jenis Kelamin</strong></label>
                                    <div class="col-md-10">
                                        <div class="col-form-label">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="jen_kel" id="jen_kel1" class="form-check-input" value="{{ config('constants.forms.jen_kel.lakilaki') }}">
                                                <label for="jen_kel1" class="form-check-label">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="jen_kel" id="jen_kel2" class="form-check-input" value="{{ config('constants.forms.jen_kel.perempuan') }}">
                                                <label for="jen_kel2" class="form-check-label">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-md col-form-label"><strong>Alamat Rumah</strong></label>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukkan alamat rumah"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label for="provinsi_id" class="col-md-auto col-form-label">Provinsi</label>
                                                    <div class="col-md">
                                                        <select name="provinsi_id" id="provinsi_id" class="form-control">
                                                            <option>Pilih Provinsi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label for="kabkota_id" class="col-md-auto col-form-label">Kota / Kab</label>
                                                    <div class="col-md">
                                                        <select name="kabkota_id" id="kabkota_id" class="form-control">
                                                            <option>Pilih Kota / Kabupaten</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group row">
                                                    <label for="kecamatan_id" class="col-md-auto col-form-label">Kecamatan</label>
                                                    <div class="col-md">
                                                        <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                                                            <option>Pilih Kecamatan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group row">
                                                    <label for="kode_pos" class="col-md-auto col-form-label">Kode Pos</label>
                                                    <div class="col-md">
                                                        <input type="number" name="kode_pos" id="kode_pos" class="form-control" placeholder="Masukkan kode pos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group row">
                                                    <label for="desa_id" class="col-md-auto col-form-label">Kelurahan</label>
                                                    <div class="col-md">
                                                        <select name="desa_id" id="desa_id" class="form-control">
                                                            <option>Pilih Kelurahan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group row">
                                                    <label for="rt" class="col-md-auto col-form-label">RT</label>
                                                    <div class="col-md">
                                                        <input type="number" name="rt" id="rt" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group row">
                                                    <label for="rw" class="col-md-auto col-form-label">RW</label>
                                                    <div class="col-md">
                                                        <input type="number" name="rw" id="rw" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md col-form-label"><strong>Tempat & Tanggal Lahir</strong></label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label for="kabkota_lahir_id" class="col-md-auto col-form-label">Kota / Kab</label>
                                                    <div class="col-md">
                                                        <select name="kabkota_lahir_id" id="kabkota_lahir_id" class="form-control">
                                                            <option>Pilih Kota / Kabupaten</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label for="tgl_lahir" class="col-md-auto col-form-label">Tanggal</label>
                                                    <div class="col-md">
                                                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pekerjaan_id" class="col-md col-form-label"><strong>Pekerjaan</strong></label>
                                    <div class="col-md-10">
                                        <select name="pekerjaan_id" id="pekerjaan_id" class="form-control">
                                            <option>Pilih Pekerjaan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md col-form-label"><strong>Nomor Kontak</strong></label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label for="telp">Telp Rumah</label>
                                                    <input type="tel" name="telp" id="telp" class="form-control" placeholder="Masukkan nomor telp">
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label for="no_hp">HP</label>
                                                    <input type="tel" name="no_hp" id="no_hp" class="form-control" placeholder="Masukkan nomor HP">
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label for="kontak_lain">Lainnya</label>
                                                    <input type="text" name="kontak_lain" id="kontak_lain" class="form-control" placeholder="Masukkan kontak lainnya">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="asal_pemasaran_id" class="col-md col-form-label"><strong>Mengenal STMIK Bandung</strong></label>
                                    <div class="col-md-10">
                                        <select name="asal_pemasaran_id" id="asal_pemasaran_id" class="form-control">
                                            <option>Pilih Asal Mengenal STMIK Bandung</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pas_foto" class="col-md col-form-label"><strong>Pas Foto</strong></label>
                                    <div class="col-md-10">
                                        <input type="file" name="pas_foto" id="image" class="form-control">
                                        <img src="https://via.placeholder.com/300?text=Gambar" class="img-fluid" id="view_image" style="height: 180px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Biodata Orang Tua / Wali</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama_ayah" class="col-md col-form-label"><strong>Nama Lengkap Ayah</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" placeholder="Masukkan nama lengkap ayah">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_ibu" class="col-md col-form-label"><strong>Nama Lengkap Ibu</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" placeholder="Masukkan nama lengkap ibu">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md col-form-label"><strong>Pekerjaan</strong></label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-lg-auto">
                                                <div class="form-group row">
                                                    <label for="pekerjaan_ayah_id" class="col-md-auto col-form-label">Ayah</label>
                                                    <div class="col-md">
                                                        <select name="pekerjaan_ayah_id" id="pekerjaan_ayah_id" class="form-control">
                                                            <option>Pilih Pekerjaan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-auto">
                                                <div class="form-group row">
                                                    <label for="pekerjaan_ibu_id" class="col-md-auto col-form-label">Ibu</label>
                                                    <div class="col-md">
                                                        <select name="pekerjaan_ibu_id" id="pekerjaan_ibu_id" class="form-control">
                                                            <option>Pilih Pekerjaan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat_wali" class="col-md col-form-label"><strong>Alamat Rumah</strong></label>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <textarea name="alamat_wali" id="alamat_wali" rows="3" class="form-control" placeholder="Masukkan alamat rumah"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label for="provinsi_wali_id" class="col-md-auto col-form-label">Provinsi</label>
                                                    <div class="col-md">
                                                        <select name="provinsi_wali_id" id="provinsi_wali_id" class="form-control">
                                                            <option>Pilih Provinsi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label for="kabkota_wali_id" class="col-md-auto col-form-label">Kota / Kab</label>
                                                    <div class="col-md">
                                                        <select name="kabkota_wali_id" id="kabkota_wali_id" class="form-control">
                                                            <option>Pilih Kota / Kabupaten</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group row">
                                                    <label for="kecamatan_wali_id" class="col-md-auto col-form-label">Kecamatan</label>
                                                    <div class="col-md">
                                                        <select name="kecamatan_wali_id" id="kecamatan_wali_id" class="form-control">
                                                            <option>Pilih Kecamatan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group row">
                                                    <label for="kode_pos_wali" class="col-md-auto col-form-label">Kode Pos</label>
                                                    <div class="col-md">
                                                        <input type="number" name="kode_pos_wali" id="kode_pos_wali" class="form-control" placeholder="Masukkan kode pos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group row">
                                                    <label for="desa_wali_id" class="col-md-auto col-form-label">Kelurahan</label>
                                                    <div class="col-md">
                                                        <select name="desa_wali_id" id="desa_wali_id" class="form-control">
                                                            <option>Pilih Kelurahan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group row">
                                                    <label for="rt_wali" class="col-md-auto col-form-label">RT</label>
                                                    <div class="col-md">
                                                        <input type="number" name="rt_wali" id="rt_wali" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group row">
                                                    <label for="rw_wali" class="col-md-auto col-form-label">RW</label>
                                                    <div class="col-md">
                                                        <input type="number" name="rw_wali" id="rw_wali" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md col-form-label"><strong>Nomor Kontak</strong></label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label for="telp_wali">Telp Rumah</label>
                                                    <input type="tel" name="telp_wali" id="telp_wali" class="form-control" placeholder="Masukkan nomor telp">
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label for="no_hp_wali">HP</label>
                                                    <input type="tel" name="no_hp_wali" id="no_hp_wali" class="form-control" placeholder="Masukkan nomor HP">
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label for="kontak_lain_wali">Lainnya</label>
                                                    <input type="text" name="kontak_lain_wali" id="kontak_lain_wali" class="form-control" placeholder="Masukkan kontak lainnya">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('javascript')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function(){
        readURL(this);
    });
</script>
@endsection
