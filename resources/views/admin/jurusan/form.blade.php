@extends('layouts.base')

@section('title', isset($jurusan) ? 'Edit Jurusan - '.config('app.name') : 'Tambah Jurusan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.jurusan.index') }}">Jurusan</a></li>
    <li class="breadcrumb-item active">{{ isset($jurusan) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-bookmark">
                </i>&nbsp;Jurusan</strong>&nbsp;<small>Form {{ isset($jurusan) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($jurusan) ? route('admin.jurusan.update', $jurusan->id) : route('admin.jurusan.store') }}" method="post">
                @csrf
                @isset($jurusan) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Jurusan</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-auto col-form-label">Nama Jurusan</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($jurusan) ? $jurusan->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('jurusan.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
