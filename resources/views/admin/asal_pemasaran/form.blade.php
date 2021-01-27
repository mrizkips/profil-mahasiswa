@extends('layouts.base')

@section('title', isset($asal_pemasaran) ? 'Edit Asal Pemasaran - '.config('app.name') : 'Tambah Asal Pemasaran - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.asal_pemasaran.index') }}">Asal Pemasaran</a></li>
    <li class="breadcrumb-item active">{{ isset($asal_pemasaran) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-chart-line">
                </i>&nbsp;Asal Pemasaran</strong>&nbsp;<small>Form {{ isset($asal_pemasaran) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($asal_pemasaran) ? route('admin.asal_pemasaran.update', $asal_pemasaran->id) : route('admin.asal_pemasaran.store') }}" method="post">
                @csrf
                @isset($asal_pemasaran) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Asal Pemasaran</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-auto col-form-label">Nama Asal Pemasaran</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($asal_pemasaran) ? $asal_pemasaran->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => true,
                                            'placeholder' => trans('asal_pemasaran.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.asal_pemasaran.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
