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
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($mahasiswa) ? route('admin.mahasiswa.update', $mahasiswa->id) : route('admin.mahasiswa.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($mahasiswa) @method('PUT') @endif
            <div class="card card-accent-primary">
                <div class="card-header"><strong class="text-primary">Status dan Pilihan</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status_mhs" class="d-block"><strong>Status Mahasiswa*</strong></label>
                                @foreach (config('constants.forms.mahasiswa.status_mhs') as $key => $item)
                                    @include('components.radio-inline', [
                                        'name' => 'status_mhs',
                                        'id' => "status_mhs_$key",
                                        'value' => $item,
                                        'selected' => isset($profil_mhs) ? ($profil_mhs->status_mhs == $item ? 'checked' : '') : (old('status_mhs') == $item ? 'checked' : ''),
                                        'option' => $item,
                                    ])
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="asal_sekolah"><strong>Asal Sekolah / PT*</strong></label>
                                <div class="col-md-9">
                                    @include('components.input', [
                                        'type' => 'text',
                                        'name' => 'asal_sekolah',
                                        'value' => isset($profil_mhs) ? $profil_mhs->asal_sekolah : old('asal_sekolah'),
                                        'required' => false,
                                        'autofocus' => true,
                                        'placeholder' => trans('mahasiswa.placeholders.asal_sekolah'),
                                    ])
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="jurusan_asal"><strong>Jurusan*</strong></label>
                                <div class="col-md-9">
                                    @include('components.input', [
                                        'type' => 'text',
                                        'name' => 'jurusan_asal',
                                        'value' => isset($profil_mhs) ? $profil_mhs->jurusan_asal : old('jurusan_asal'),
                                        'required' => false,
                                        'autofocus' => false,
                                        'placeholder' => trans('mahasiswa.placeholders.jurusan_asal'),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group row">
                                <label for="jurusan_id" class="col-md-auto col-form-label"><strong>Jurusan Pilihan*</strong></label>
                                <div class="col-md col-form-label">
                                    @foreach ($jurusan as $item)
                                        @include('components.radio-inline', [
                                            'name' => 'jurusan_id',
                                            'id' => "jurusan_id_$item->id",
                                            'value' => $item->id,
                                            'selected' => isset($profil_mhs) ? ($profil_mhs->jurusan_id == $item->id ? 'checked' : '') : (old('jurusan_id') == $item->id ? 'checked' : ''),
                                            'option' => $item->nama,
                                        ])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group row">
                                <label for="no_test" class="col-md-4 col-form-label"><strong>Nomor Test Masuk*</strong></label>
                                <div class="col-md-8">
                                    @include('components.input', [
                                        'type' => 'text',
                                        'name' => 'no_test',
                                        'value' => isset($profil_mhs) ? $profil_mhs->no_test : old('no_test'),
                                        'required' => false,
                                        'autofocus' => false,
                                        'placeholder' => trans('mahasiswa.placeholders.no_test'),
                                    ])
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="thn_masuk" class="col-md-auto col-form-label"><strong>Tahun Masuk*</strong></label>
                                <div class="col-md">
                                    @include('components.input', [
                                        'type' => 'number',
                                        'name' => 'thn_masuk',
                                        'value' => isset($profil_mhs) ? $profil_mhs->thn_masuk : old('thn_masuk'),
                                        'required' => false,
                                        'autofocus' => false,
                                        'placeholder' => trans('mahasiswa.placeholders.thn_masuk'),
                                    ])
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
                        <label for="nama" class="col-md col-form-label"><strong>Nama Lengkap*</strong></label>
                        <div class="col-md-10">
                            @include('components.input', [
                                'type' => 'text',
                                'name' => 'nama',
                                'value' => isset($profil_mhs) ? $profil_mhs->nama : old('nama'),
                                'required' => false,
                                'autofocus' => false,
                                'placeholder' => trans('mahasiswa.placeholders.nama'),
                            ])
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-md col-form-label"><strong>NIM*</strong></label>
                        <div class="col-md-10">
                            @include('components.input', [
                                'type' => 'text',
                                'name' => 'username',
                                'value' => isset($mahasiswa) ? $mahasiswa->username : old('username'),
                                'required' => false,
                                'autofocus' => false,
                                'readonly' => isset($mahasiswa),
                                'placeholder' => trans('mahasiswa.placeholders.username'),
                            ])
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jen_kel" class="col-md col-form-label"><strong>Jenis Kelamin*</strong></label>
                        <div class="col-md-10">
                            <div class="col-form-label">
                                @foreach (config('constants.forms.jen_kel') as $key => $item)
                                    @include('components.radio-inline', [
                                        'name' => 'jen_kel',
                                        'id' => "jurusan_id_$key",
                                        'value' => $key,
                                        'selected' => isset($profil_mhs) ? ($profil_mhs->jen_kel == $key ? 'checked' : '') : (old('jen_kel') == $key ? 'checked' : ''),
                                        'option' => $item,
                                    ])
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md col-form-label"><strong>Alamat Rumah*</strong></label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ trans('mahasiswa.placeholders.alamat') }}">{{ isset($profil_mhs) ? $profil_mhs->alamat : old('alamat') }}</textarea>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="provinsi_id" class="col-md-auto col-form-label">Provinsi*</label>
                                        <div class="col-md">
                                            <select name="provinsi_id" id="provinsi_id" class="form-control select2 @error('provinsi_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->provinsi_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->provinsi->nama : trans('mahasiswa.placeholders.provinsi_id') }}
                                                </option>
                                            </select>
                                            @error('provinsi_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="kabkota_id" class="col-md-auto col-form-label">Kab / Kota*</label>
                                        <div class="col-md">
                                            <select name="kabkota_id" id="kabkota_id" class="form-control select2 @error('kabkota_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->kabkota_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->kabkota->nama : trans('mahasiswa.placeholders.kabkota_id') }}
                                                </option>
                                            </select>
                                            @error('kabkota_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group row">
                                        <label for="kecamatan_id" class="col-md-auto col-form-label">Kecamatan*</label>
                                        <div class="col-md">
                                            <select name="kecamatan_id" id="kecamatan_id" class="form-control select2 @error('kecamatan_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->kecamatan_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->kecamatan->nama : trans('mahasiswa.placeholders.kecamatan_id') }}
                                                </option>
                                            </select>
                                            @error('kecamatan_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="kode_pos" class="col-md-auto col-form-label">Kode Pos*</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'number',
                                                'name' => 'kode_pos',
                                                'value' => isset($profil_mhs) ? $profil_mhs->kode_pos : old('kode_pos'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.kode_pos'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="desa_id" class="col-md-auto col-form-label">Desa/Kelurahan*</label>
                                        <div class="col-md">
                                            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->desa_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->desa->nama : trans('mahasiswa.placeholders.desa_id') }}
                                                </option>
                                            </select>
                                            @error('desa_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group row">
                                        <label for="rt" class="col-md-auto col-form-label">RT*</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'number',
                                                'name' => 'rt',
                                                'value' => isset($profil_mhs) ? $profil_mhs->rt : old('rt'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.rt'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group row">
                                        <label for="rw" class="col-md-auto col-form-label">RW*</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'number',
                                                'name' => 'rw',
                                                'value' => isset($profil_mhs) ? $profil_mhs->rw : old('rw'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.rw'),
                                            ])
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
                                        <label for="kabkota_lahir_id" class="col-md-auto col-form-label">Kab / Kota*</label>
                                        <div class="col-md">
                                            <select name="kabkota_lahir_id" id="kabkota_lahir_id" class="form-control select2 @error('kabkota_lahir_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->kabkota_lahir_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->kabkota_lahir->nama : trans('mahasiswa.placeholders.kabkota_lahir_id') }}
                                                </option>
                                            </select>
                                            @error('kabkota_lahir_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="tgl_lahir" class="col-md-auto col-form-label">Tanggal*</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'date',
                                                'name' => 'tgl_lahir',
                                                'value' => isset($profil_mhs) ? $profil_mhs->tgl_lahir : old('tgl_lahir'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.tgl_lahir'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pekerjaan_id" class="col-md col-form-label"><strong>Pekerjaan*</strong></label>
                        <div class="col-md-10">
                            <select name="pekerjaan_id" id="pekerjaan_id" class="form-control select2 @error('pekerjaan_id') is-invalid @enderror">
                                <option>{{ trans('mahasiswa.placeholders.pekerjaan_id') }}</option>
                                @foreach ($pekerjaan as $item)
                                    <option value="{{$item->id}}" {{ isset($profil_mhs) ? ($profil_mhs->pekerjaan_id == $item->id ? 'selected' : '') : (old('pekerjaan_id') == $item->id ? 'selected' : '') }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('pekerjaan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md col-form-label"><strong>Nomor Kontak</strong></label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="telp">Telp Rumah</label>
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'telp',
                                            'value' => isset($profil_mhs) ? $profil_mhs->telp : old('telp'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('mahasiswa.placeholders.telp'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="no_hp">HP*</label>
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'no_hp',
                                            'value' => isset($profil_mhs) ? $profil_mhs->no_hp : old('no_hp'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('mahasiswa.placeholders.no_hp'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="kontak_lain">Lainnya</label>
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'kontak_lain',
                                            'value' => isset($profil_mhs) ? $profil_mhs->kontak_lain : old('kontak_lain'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('mahasiswa.placeholders.kontak_lain'),
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md col-form-label"><strong>Email & Website</strong></label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="email" class="col-md-auto col-form-label">Email*</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'email',
                                                'name' => 'email',
                                                'value' => isset($profil_mhs) ? $profil_mhs->email : old('email'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.email'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="website" class="col-md-auto col-form-label">Website</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'text',
                                                'name' => 'website',
                                                'value' => isset($profil_mhs) ? $profil_mhs->website : old('website'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.website'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asal_pemasaran_id" class="col-md col-form-label"><strong>Mengenal STMIK Bandung*</strong></label>
                        <div class="col-md-10">
                            <select name="asal_pemasaran_id" id="asal_pemasaran_id" class="form-control select2 @error('asal_pemasaran_id') is-invalid @enderror">
                                <option>{{ trans('mahasiswa.placeholders.asal_pemasaran_id') }}</option>
                                @foreach ($asal_pemasaran as $item)
                                    <option value="{{$item->id}}" {{ isset($profil_mhs) ? ($profil_mhs->asal_pemasaran_id == $item->id ? 'selected' : '') : (old('asal_pemasaran_id') == $item->id ? 'selected' : '') }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('asal_pemasaran_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pas_foto" class="col-md col-form-label"><strong>Pas Foto</strong></label>
                        <div class="col-md-10">
                            <input type="file" name="pas_foto" id="pas_foto" class="form-control @error('pas_foto') is-invalid @enderror">
                            @error('pas_foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <img src="https://via.placeholder.com/300?text=Gambar" class="img-fluid" id="view_image" style="height: 180px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-accent-primary">
                <div class="card-header"><strong class="text-primary">Biodata Orang Tua / Wali</strong></div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama_ayah" class="col-md col-form-label"><strong>Nama Lengkap Ayah*</strong></label>
                        <div class="col-md-10">
                            @include('components.input', [
                                'type' => 'text',
                                'name' => 'nama_ayah',
                                'value' => isset($profil_mhs) ? $profil_mhs->nama_ayah : old('nama_ayah'),
                                'required' => false,
                                'autofocus' => false,
                                'placeholder' => trans('mahasiswa.placeholders.nama_ayah'),
                            ])
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_ibu" class="col-md col-form-label"><strong>Nama Lengkap Ibu*</strong></label>
                        <div class="col-md-10">
                            @include('components.input', [
                                'type' => 'text',
                                'name' => 'nama_ibu',
                                'value' => isset($profil_mhs) ? $profil_mhs->nama_ibu : old('nama_ibu'),
                                'required' => false,
                                'autofocus' => false,
                                'placeholder' => trans('mahasiswa.placeholders.nama_ibu'),
                            ])
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md col-form-label"><strong>Pekerjaan</strong></label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-lg-auto">
                                    <div class="form-group row">
                                        <label for="pekerjaan_ayah_id" class="col-md-auto col-form-label">Ayah*</label>
                                        <div class="col-md">
                                            <select name="pekerjaan_ayah_id" id="pekerjaan_ayah_id" class="form-control select2 @error('pekerjaan_ayah_id') is-invalid @enderror">
                                                <option>{{ trans('mahasiswa.placeholders.pekerjaan_ayah_id') }}</option>
                                                @foreach ($pekerjaan as $item)
                                                    <option value="{{$item->id}}" {{ isset($profil_mhs) ? ($profil_mhs->pekerjaan_ayah_id == $item->id ? 'selected' : '') : (old('pekerjaan_ayah_id') == $item->id ? 'selected' : '') }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('pekerjaan_ayah_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-auto">
                                    <div class="form-group row">
                                        <label for="pekerjaan_ibu_id" class="col-md-auto col-form-label">Ibu*</label>
                                        <div class="col-md">
                                            <select name="pekerjaan_ibu_id" id="pekerjaan_ibu_id" class="form-control select2 @error('pekerjaan_ibu_id') is-invalid @enderror">
                                                <option>{{ trans('mahasiswa.placeholders.pekerjaan_ibu_id') }}</option>
                                                @foreach ($pekerjaan as $item)
                                                    <option value="{{$item->id}}" {{ isset($profil_mhs) ? ($profil_mhs->pekerjaan_ibu_id == $item->id ? 'selected' : '') : (old('pekerjaan_ibu_id') == $item->id ? 'selected' : '') }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('pekerjaan_ibu_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat_wali" class="col-md col-form-label"><strong>Alamat Rumah*</strong></label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <textarea name="alamat_wali" id="alamat_wali" class="form-control @error('alamat_wali') is-invalid @enderror" placeholder="{{ trans('mahasiswa.placeholders.alamat_wali') }}">{{ isset($profil_mhs) ? $profil_mhs->alamat_wali : old('alamat_wali') }}</textarea>
                                @error('alamat_wali')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="provinsi_wali_id" class="col-md-auto col-form-label">Provinsi*</label>
                                        <div class="col-md">
                                            <select name="provinsi_wali_id" id="provinsi_wali_id" class="form-control select2 @error('provinsi_wali_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->provinsi_wali_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->provinsi_wali->nama : trans('mahasiswa.placeholders.provinsi_wali_id') }}
                                                </option>
                                            </select>
                                            @error('provinsi_wali_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="kabkota_wali_id" class="col-md-auto col-form-label">Kota / Kab*</label>
                                        <div class="col-md">
                                            <select name="kabkota_wali_id" id="kabkota_wali_id" class="form-control select2 @error('kabkota_wali_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->kabkota_wali_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->kabkota_wali->nama : trans('mahasiswa.placeholders.kabkota_wali_id') }}
                                                </option>
                                            </select>
                                            @error('kabkota_wali_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group row">
                                        <label for="kecamatan_wali_id" class="col-md-auto col-form-label">Kecamatan*</label>
                                        <div class="col-md">
                                            <select name="kecamatan_wali_id" id="kecamatan_wali_id" class="form-control select2 @error('kecamatan_wali_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->kecamatan_wali_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->kecamatan_wali->nama : trans('mahasiswa.placeholders.kecamatan_wali_id') }}
                                                </option>
                                            </select>
                                            @error('kecamatan_wali_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="kode_pos_wali" class="col-md-auto col-form-label">Kode Pos*</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'number',
                                                'name' => 'kode_pos_wali',
                                                'value' => isset($profil_mhs) ? $profil_mhs->kode_pos_wali : old('kode_pos_wali'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.kode_pos_wali'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="desa_wali_id" class="col-md-auto col-form-label">Kelurahan*</label>
                                        <div class="col-md">
                                            <select name="desa_wali_id" id="desa_wali_id" class="form-control select2 @error('desa_wali_id') is-invalid @enderror">
                                                <option {{ isset($profil_mhs) ? "value=".$profil_mhs->desa_wali_id : "" }}>
                                                    {{ isset($profil_mhs) ? $profil_mhs->desa_wali->nama : trans('mahasiswa.placeholders.desa_wali_id') }}
                                                </option>
                                            </select>
                                            @error('desa_wali_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group row">
                                        <label for="rt_wali" class="col-md-auto col-form-label">RT*</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'number',
                                                'name' => 'rt_wali',
                                                'value' => isset($profil_mhs) ? $profil_mhs->rt_wali : old('rt_wali'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.rt_wali'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group row">
                                        <label for="rw_wali" class="col-md-auto col-form-label">RW*</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'number',
                                                'name' => 'rw_wali',
                                                'value' => isset($profil_mhs) ? $profil_mhs->rw_wali : old('rw_wali'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('mahasiswa.placeholders.rw_wali'),
                                            ])
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
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'telp_wali',
                                            'value' => isset($profil_mhs) ? $profil_mhs->telp_wali : old('telp_wali'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('mahasiswa.placeholders.telp_wali'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="no_hp_wali">HP*</label>
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'no_hp_wali',
                                            'value' => isset($profil_mhs) ? $profil_mhs->no_hp_wali : old('no_hp_wali'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('mahasiswa.placeholders.no_hp_wali'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="kontak_lain_wali">Lainnya</label>
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'kontak_lain_wali',
                                            'value' => isset($profil_mhs) ? $profil_mhs->kontak_lain_wali : old('kontak_lain_wali'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('mahasiswa.placeholders.kontak_lain_wali'),
                                        ])
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

    $("#pas_foto").change(function(){
        readURL(this);
    });

    $(function() {
        var provinsi_id,
            kabkota_id,
            kecamatan_id,
            provinsi_wali_id,
            kabkota_wali_id
            kecamatan_wali_id;

        $("#provinsi_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.provinsi.index') }}",
                data: function (params) {
                    var query = {
                        provinsi: $.trim(params.term) || "",
                    }
                    provinsi_id = params.term;
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        }).on('change', function () {
            provinsi_id = this.value;
        })

        $("#kabkota_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.kabkota.index') }}",
                data: function (params) {
                    var query = {
                        kabkota: $.trim(params.term) || "",
                        provinsi_id: provinsi_id
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        }).on('change', function () {
            kabkota_id = this.value;
        })

        $("#kecamatan_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.kecamatan.index') }}",
                data: function (params) {
                    var query = {
                        kecamatan: $.trim(params.term) || "",
                        kabkota_id: kabkota_id
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        }).on('change', function () {
            kecamatan_id = this.value;
        })

        $("#desa_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.desa.index') }}",
                data: function (params) {
                    var query = {
                        desa: $.trim(params.term) || "",
                        kecamatan_id: kecamatan_id
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        })

        $("#kabkota_lahir_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.kabkota.index') }}",
                data: function (params) {
                    var query = {
                        kabkota: $.trim(params.term) || "",
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        })

        $("#provinsi_wali_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.provinsi.index') }}",
                data: function (params) {
                    var query = {
                        provinsi: $.trim(params.term) || "",
                    }
                    provinsi_id = params.term;
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        }).on('change', function () {
            provinsi_wali_id = this.value;
        })

        $("#kabkota_wali_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.kabkota.index') }}",
                data: function (params) {
                    var query = {
                        kabkota: $.trim(params.term) || "",
                        provinsi_id: provinsi_wali_id
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        }).on('change', function () {
            kabkota_wali_id = this.value;
        })

        $("#kecamatan_wali_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.kecamatan.index') }}",
                data: function (params) {
                    var query = {
                        kecamatan: $.trim(params.term) || "",
                        kabkota_id: kabkota_wali_id
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        }).on('change', function () {
            kecamatan_wali_id = this.value;
        })

        $("#desa_wali_id").select2({
            language: "id",
            theme: "bootstrap4",
            minimumInputLength: 2,
            ajax: {
                delay: 500,
                url: "{{ route('admin.desa.index') }}",
                data: function (params) {
                    var query = {
                        desa: $.trim(params.term) || "",
                        kecamatan_id: kecamatan_wali_id
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                }
            },
            cache: true
        })
    })
</script>
@endsection
