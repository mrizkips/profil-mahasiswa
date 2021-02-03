@extends('layouts.base')

@section('title', isset($tahun_akademik) ? 'Edit Tahun Akademik - '.config('app.name') : 'Tambah Tahun Akademik - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.tahun_akademik.index') }}">Tahun Akademik</a></li>
    <li class="breadcrumb-item active">{{ isset($tahun_akademik) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-institution">
                </i>&nbsp;Tahun Akademik</strong>&nbsp;<small>Form {{ isset($tahun_akademik) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($tahun_akademik) ? route('admin.tahun_akademik.update', $tahun_akademik->id) : route('admin.tahun_akademik.store') }}" method="post">
                @csrf
                @isset($tahun_akademik) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Tahun Akademik</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-auto col-form-label">Nama Tahun Akademik</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($tahun_akademik) ? $tahun_akademik->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('tahun_akademik.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.tahun_akademik.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
