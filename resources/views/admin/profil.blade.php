@extends('layouts.base')

@section('title', 'Profil Admin - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Profil Admin</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-settings">
            </i>&nbsp;Profil Admin</strong>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ route('admin.profil.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card card-accent-primary">
                <div class="card-header"><strong class="text-primary">Biodata Admin</strong></div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="username" class="col-md col-form-label"><strong>Nama Pengguna</strong></label>
                        <div class="col-md-10">
                            <input type="text" name="nama" id="nama" class="form-control-plaintext" value="{{ $admin->username }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md col-form-label"><strong>Nama Lengkap*</strong></label>
                        <div class="col-md-10">
                            @include('components.input', [
                                'type' => 'text',
                                'name' => 'nama',
                                'value' => isset($profil_admin) ? $profil_admin->nama : old('nama'),
                                'required' => false,
                                'autofocus' => false,
                                'placeholder' => trans('admin.placeholders.nama'),
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
                                        'selected' => isset($profil_admin) ? ($profil_admin->jen_kel == $key ? 'checked' : '') : (old('jen_kel') == $key ? 'checked' : ''),
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
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ trans('admin.placeholders.alamat') }}">{{ isset($profil_admin) ? $profil_admin->alamat : old('alamat') }}</textarea>
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
                                                <option {{ isset($profil_admin->provinsi) ? "value=".$profil_admin->provinsi_id : "" }}>
                                                    {{ isset($profil_admin->provinsi) ? $profil_admin->provinsi->nama : trans('admin.placeholders.provinsi_id') }}
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
                                                <option {{ isset($profil_admin->kabkota) ? "value=".$profil_admin->kabkota_id : "" }}>
                                                    {{ isset($profil_admin->kabkota) ? $profil_admin->kabkota->nama : trans('admin.placeholders.kabkota_id') }}
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
                                                <option {{ isset($profil_admin->kecamatan) ? "value=".$profil_admin->kecamatan_id : "" }}>
                                                    {{ isset($profil_admin->kecamatan) ? $profil_admin->kecamatan->nama : trans('admin.placeholders.kecamatan_id') }}
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
                                                'value' => isset($profil_admin) ? $profil_admin->kode_pos : old('kode_pos'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('admin.placeholders.kode_pos'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="desa_id" class="col-md-auto col-form-label">Desa/Kelurahan*</label>
                                        <div class="col-md">
                                            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                                                <option {{ isset($profil_admin->desa) ? "value=".$profil_admin->desa_id : "" }}>
                                                    {{ isset($profil_admin->desa) ? $profil_admin->desa->nama : trans('admin.placeholders.desa_id') }}
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
                                        <label for="rt" class="col-md-auto col-form-label">RT</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'number',
                                                'name' => 'rt',
                                                'value' => isset($profil_admin) ? $profil_admin->rt : old('rt'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('admin.placeholders.rt'),
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group row">
                                        <label for="rw" class="col-md-auto col-form-label">RW</label>
                                        <div class="col-md">
                                            @include('components.input', [
                                                'type' => 'number',
                                                'name' => 'rw',
                                                'value' => isset($profil_admin) ? $profil_admin->rw : old('rw'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('admin.placeholders.rw'),
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
                                                <option {{ isset($profil_admin->kabkota_lahir) ? "value=".$profil_admin->kabkota_lahir_id : "" }}>
                                                    {{ isset($profil_admin->kabkota_lahir) ? $profil_admin->kabkota_lahir->nama : trans('admin.placeholders.kabkota_lahir_id') }}
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
                                                'value' => isset($profil_admin) ? $profil_admin->tgl_lahir : old('tgl_lahir'),
                                                'required' => false,
                                                'autofocus' => false,
                                                'placeholder' => trans('admin.placeholders.tgl_lahir'),
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
                                        <label for="telp">Telp Rumah</label>
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'telp',
                                            'value' => isset($profil_admin) ? $profil_admin->telp : old('telp'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('admin.placeholders.telp'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="no_hp">HP</label>
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'no_hp',
                                            'value' => isset($profil_admin) ? $profil_admin->no_hp : old('no_hp'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('admin.placeholders.no_hp'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="kontak_lain">Lainnya</label>
                                        @include('components.input', [
                                            'type' => 'tel',
                                            'name' => 'kontak_lain',
                                            'value' => isset($profil_admin) ? $profil_admin->kontak_lain : old('kontak_lain'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('admin.placeholders.kontak_lain'),
                                        ])
                                    </div>
                                </div>
                            </div>
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
                <div class="card-footer">
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

    var provinsi_id,
        kabkota_id,
        kecamatan_id;

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
</script>
@endsection
