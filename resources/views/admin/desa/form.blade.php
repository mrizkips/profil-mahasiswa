@extends('layouts.base')

@section('title', isset($desa) ? 'Edit Desa - '.config('app.name') : 'Tambah Desa - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item">Wilayah</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.desa.index') }}">Desa</a></li>
    <li class="breadcrumb-item active">{{ isset($desa) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-map">
                </i>&nbsp;Desa</strong>&nbsp;<small>Form {{ isset($desa) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($desa) ? route('admin.desa.update', $desa->id) : route('admin.desa.store') }}" method="post">
                @csrf
                @isset($desa) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Desa</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-3 col-form-label">Nama Desa</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($desa) ? $desa->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('desa.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kecamatan_id" class="col-md-3 col-form-label">Kecamatan</label>
                                    <div class="col-md">
                                        <select name="kecamatan_id" id="kecamatan_id" class="form-control select2 @error('kecamatan_id') is-invalid @enderror">
                                            <option {{ isset($desa) ? "value=".$desa->kecamatan->id : "" }}>
                                                {{ isset($desa) ? $desa->kecamatan->nama : trans('desa.placeholders.kecamatan_id') }}
                                            </option>
                                        </select>
                                        @error('kecamatan_id')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.desa.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
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
                url: "{{ route('admin.kecamatan.index') }}",
                data: function (params) {
                    var query = {
                        kecamatan: $.trim(params.term) || "",
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
