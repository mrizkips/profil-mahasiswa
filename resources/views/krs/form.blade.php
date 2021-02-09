@extends('layouts.base')

@section('title', isset($krs) ? 'Edit KRS - '.config('app.name') : 'Tambah KRS - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('krs.index') }}">KRS</a></li>
    <li class="breadcrumb-item active">{{ isset($krs) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-task">
                </i>&nbsp;KRS</strong>&nbsp;<small>Form {{ isset($krs) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($krs) ? route('krs.update', $krs->id) : route('krs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($krs) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data KRS</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="semester_id" class="col-md-3 col-form-label">Semester</label>
                                    <div class="col-md">
                                        <select name="semester_id" id="semester_id" class="form-control @error('semester_id') is-invalid @enderror">
                                            <option>{{ trans('krs.placeholders.semester_id') }}</option>
                                            @foreach ($semester as $item)
                                            <option value="{{ $item->id }}"
                                                @php
                                                    if ($semester_id = $request->input('semester_id')) {
                                                        echo $semester_id == $item->id ? 'selected' : '';
                                                    } else {
                                                        echo isset($krs) ? ($krs->semester_id == $item->id ? 'selected' : '') :
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
                                    <label for="jumlah" class="col-md-3 col-form-label">Jumlah SKS</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'number',
                                            'name' => 'jumlah',
                                            'value' => isset($krs) ? $krs->jumlah : old('jumlah'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('krs.placeholders.jumlah'),
                                        ])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="catatan" class="col-md-3 col-form-label">Catatan</label>
                                    <div class="col-md">
                                        <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder="{{ trans('krs.placeholders.catatan') }}">{{ isset($krs) ? $krs->catatan : old('catatan') }}</textarea>
                                        @error('catatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_upload" class="col-md-3 col-form-label">Bukti KRS</label>
                                    <div class="col-md">
                                        @include('components.input', [
                                            'type' => 'file',
                                            'name' => 'file_upload',
                                            'value' => old('file_upload'),
                                            'required' => false,
                                            'autofocus' => false,
                                            'placeholder' => trans('krs.placeholders.file_upload'),
                                        ])
                                        <small class="form-text text-muted">Format file berupa .pdf</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('krs.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
