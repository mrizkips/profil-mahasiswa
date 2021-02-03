@extends('layouts.base')

@section('title', isset($kabkota) ? 'Edit Kabupaten/Kota - '.config('app.name') : 'Tambah Kabupaten/Kota - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item">Wilayah</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kabkota.index') }}">Kabupaten/Kota</a></li>
    <li class="breadcrumb-item active">{{ isset($kabkota) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-map">
                </i>&nbsp;Kabupaten/Kota</strong>&nbsp;<small>Form {{ isset($kabkota) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($kabkota) ? route('admin.kabkota.update', $kabkota->id) : route('admin.kabkota.store') }}" method="post">
                @csrf
                @isset($kabkota) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Kabupaten/Kota</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-3 col-form-label">Nama Kabupaten/Kota</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($kabkota) ? $kabkota->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('kabkota.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="provinsi_id" class="col-md-3 col-form-label">Provinsi</label>
                                    <div class="col-md">
                                        <select name="provinsi_id" id="provinsi_id" class="form-control select2 @error('provinsi_id') is-invalid @enderror">
                                            <option {{ isset($kabkota) ? "value=".$kabkota->provinsi->id : "" }}>
                                                {{ isset($kabkota) ? $kabkota->provinsi->nama : trans('kabkota.placeholders.provinsi_id') }}
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
                            <div class="card-footer">
                                <a href="{{ route('admin.kabkota.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
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
                url: "{{ route('admin.provinsi.index') }}",
                data: function (params) {
                    var query = {
                        provinsi: $.trim(params.term) || "",
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
