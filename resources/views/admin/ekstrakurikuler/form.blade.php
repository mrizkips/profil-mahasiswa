@extends('layouts.base')

@section('title', isset($ekstrakurikuler) ? 'Edit Ekstrakurikuler - '.config('app.name') : 'Tambah Ekstrakurikuler - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.ekstrakurikuler.index') }}">Ekstrakurikuler</a></li>
    <li class="breadcrumb-item active">{{ isset($ekstrakurikuler) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-baseketball">
                </i>&nbsp;Ekstrakurikuler</strong>&nbsp;<small>Form {{ isset($ekstrakurikuler) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($ekstrakurikuler) ? route('admin.ekstrakurikuler.update', $ekstrakurikuler->id) : route('admin.ekstrakurikuler.store') }}" method="post">
                @csrf
                @isset($ekstrakurikuler) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Ekstrakurikuler</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-auto col-form-label">Nama Ekstrakurikuler</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($ekstrakurikuler) ? $ekstrakurikuler->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('ekstrakurikuler.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
