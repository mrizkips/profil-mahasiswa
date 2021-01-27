@extends('layouts.base')

@section('title', isset($pekerjaan) ? 'Edit Pekerjaan - '.config('app.name') : 'Tambah Pekerjaan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pekerjaan.index') }}">Pekerjaan</a></li>
    <li class="breadcrumb-item active">{{ isset($pekerjaan) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-watch">
                </i>&nbsp;Pekerjaan</strong>&nbsp;<small>Form {{ isset($pekerjaan) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($pekerjaan) ? route('admin.pekerjaan.update', $pekerjaan->id) : route('admin.pekerjaan.store') }}" method="post">
                @csrf
                @isset($pekerjaan) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Pekerjaan</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-auto col-form-label">Nama Pekerjaan</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($pekerjaan) ? $pekerjaan->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('pekerjaan.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.pekerjaan.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
