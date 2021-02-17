@extends('layouts.base')

@section('title', isset($kegiatan) ? 'Edit Kegiatan - '.config('app.name') : 'Tambah Kegiatan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
    <li class="breadcrumb-item active">{{ isset($kegiatan) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-calendar">
                </i>&nbsp;Kegiatan</strong>&nbsp;<small>Form {{ isset($kegiatan) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($kegiatan) ? route('kegiatan.update', $kegiatan->id) : route('kegiatan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($kegiatan) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Kegiatan</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="semester_id" class="col-md-3 col-form-label">Semester</label>
                                    <div class="col-md">
                                        <select name="semester_id" id="semester_id" class="form-control @error('semester_id') is-invalid @enderror">
                                            <option>{{ trans('kegiatan.placeholders.semester_id') }}</option>
                                            @foreach ($semester as $item)
                                            <option value="{{ $item->id }}"
                                                @php
                                                    if ($semester_id = $request->input('semester_id')) {
                                                        echo $semester_id == $item->id ? 'selected' : '';
                                                    } else {
                                                        echo isset($kegiatan) ? ($kegiatan->semester_id == $item->id ? 'selected' : '') :
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
                                    <label for="nama" class="col-md-3 col-form-label">Nama Kegiatan</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'nama',
                                            'value' => isset($kegiatan) ? $kegiatan->nama : old('nama'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('kegiatan.placeholders.nama'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="penyelenggara" class="col-md-3 col-form-label">Penyelenggara</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'text',
                                            'name' => 'penyelenggara',
                                            'value' => isset($kegiatan) ? $kegiatan->penyelenggara : old('penyelenggara'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('kegiatan.placeholders.penyelenggara'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tingkat" class="col-md-3 col-form-label">Tingkat</label>
                                    <div class="col-md">
                                        <select name="tingkat" id="tingkat" class="form-control @error('tingkat') is-invalid @enderror">
                                            <option>{{ trans('kegiatan.placeholders.tingkat') }}</option>
                                            @foreach (config('constants.forms.tingkat') as $tingkat)
                                            <option value="{{ $tingkat }}" {{ isset($kegiatan) ? ($kegiatan->tingkat == $tingkat ? 'selected' : '') : (old('tingkat') == $tingkat ? 'selected' : '') }}>
                                                {{ $tingkat }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('tingkat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_upload" class="col-md-3 col-form-label">Bukti Kegiatan</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'file',
                                            'name' => 'file_upload',
                                            'value' => old('file_upload'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('kegiatan.placeholders.file_upload'),
                                        ])
                                        <small class="form-text text-muted">Format file berupa .pdf</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
