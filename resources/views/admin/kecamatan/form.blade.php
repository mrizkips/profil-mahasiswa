@extends('layouts.base')

@section('title', isset($kecamatan) ? 'Edit Kecamatan - '.config('app.name') : 'Tambah Kecamatan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item">Wilayah</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kecamatan.index') }}">Kecamatan</a></li>
    <li class="breadcrumb-item active">{{ isset($kecamatan) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-map">
                </i>&nbsp;Kecamatan</strong>&nbsp;<small>Form {{ isset($kecamatan) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($kecamatan) ? route('admin.kecamatan.update', $kecamatan->id) : route('admin.kecamatan.store') }}" method="post">
                @csrf
                @isset($kecamatan) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Kecamatan</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-3 col-form-label">Nama Kecamatan</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($kecamatan) ? $kecamatan->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('kecamatan.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kabkota_id" class="col-md-3 col-form-label">Kabupaten/Kota</label>
                                    <div class="col-md">
                                        <select name="kabkota_id" id="kabkota_id" class="form-control select2 @error('kabkota_id') is-invalid @enderror">
                                            <option {{ isset($kecamatan) ? "value=".$kecamatan->kabkota->id : "" }}>
                                                {{ isset($kecamatan) ? $kecamatan->kabkota->nama : trans('kecamatan.placeholders.kabkota_id') }}
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
                            <div class="card-footer">
                                <a href="{{ route('admin.kecamatan.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
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
<script>
    $(function() {
        $(".select2").select2({
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
    })
</script>
@endsection
