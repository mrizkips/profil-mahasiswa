@extends('layouts.base')

@section('title', isset($sertifikasi) ? 'Edit Sertifikasi - '.config('app.name') : 'Tambah Sertifikasi - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('sertifikasi.index') }}">Sertifikasi</a></li>
    <li class="breadcrumb-item active">{{ isset($sertifikasi) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-school">
                </i>&nbsp;Sertifikasi</strong>&nbsp;<small>Form {{ isset($sertifikasi) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($sertifikasi) ? route('sertifikasi.update', $sertifikasi->id) : route('sertifikasi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($sertifikasi) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Sertifikasi</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="semester_id" class="col-md-3 col-form-label">Semester</label>
                                    <div class="col-md">
                                        <select name="semester_id" id="semester_id" class="form-control @error('semester_id') is-invalid @enderror">
                                            <option>{{ trans('sertifikasi.placeholders.semester_id') }}</option>
                                            @foreach ($semester as $item)
                                            <option value="{{ $item->id }}"
                                                @php
                                                    if ($semester_id = $request->input('semester_id')) {
                                                        echo $semester_id == $item->id ? 'selected' : '';
                                                    } else {
                                                        echo isset($sertifikasi) ? ($sertifikasi->semester_id == $item->id ? 'selected' : '') :
                                                        (old('semester_id') == $item->id ? 'selected' : '');
                                                    }
                                                @endphp>
                                                {{ $item->tahun_akademik->nama." - {$item->tipe}" }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('semester_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-md-3 col-form-label">Nama Sertifikasi</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($sertifikasi) ? $sertifikasi->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('sertifikasi.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lembaga" class="col-md-3 col-form-label">Lembaga</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'lembaga',
                                            'value' => isset($sertifikasi) ? $sertifikasi->lembaga : old('lembaga'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('sertifikasi.placeholders.lembaga'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nilai" class="col-md-3 col-form-label">Nilai</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nilai',
                                            'value' => isset($sertifikasi) ? $sertifikasi->nilai : old('nilai'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('sertifikasi.placeholders.nilai'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="catatan" class="col-md-3 col-form-label">Catatan</label>
                                    <div class="col-md">
                                        <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder="{{ trans('sertifikasi.placeholders.catatan') }}">{{ isset($sertifikasi) ? $sertifikasi->catatan : old('catatan') }}</textarea>
                                        @error('catatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_upload" class="col-md-3 col-form-label">Bukti Sertifikasi</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'file',
                                            'name' => 'file_upload',
                                            'value' => old('file_upload'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('sertifikasi.placeholders.file_upload'),
                                        ])
                                        <small class="form-text text-muted">Format file berupa .pdf</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('sertifikasi.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
