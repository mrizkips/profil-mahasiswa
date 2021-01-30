@extends('layouts.base')

@section('title', isset($provinsi) ? 'Edit Provinsi - '.config('app.name') : 'Tambah Provinsi - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item">Wilayah</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.provinsi.index') }}">Provinsi</a></li>
    <li class="breadcrumb-item active">{{ isset($provinsi) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-map">
                </i>&nbsp;Provinsi</strong>&nbsp;<small>Form {{ isset($provinsi) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($provinsi) ? route('admin.provinsi.update', $provinsi->id) : route('admin.provinsi.store') }}" method="post">
                @csrf
                @isset($provinsi) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Provinsi</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-auto col-form-label">Nama Provinsi</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($provinsi) ? $provinsi->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('provinsi.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.provinsi.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
