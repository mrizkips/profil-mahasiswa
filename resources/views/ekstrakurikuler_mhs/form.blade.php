@extends('layouts.base')

@section('title', isset($ekstrakurikuler_mhs) ? 'Edit Ekstrakurikuler - '.config('app.name') : 'Tambah Ekstrakurikuler - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('ekstrakurikuler_mhs.index') }}">Ekstrakurikuler</a></li>
    <li class="breadcrumb-item active">{{ isset($ekstrakurikuler_mhs) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-basketball">
                </i>&nbsp;Ekstrakurikuler</strong>&nbsp;<small>Form {{ isset($ekstrakurikuler_mhs) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($ekstrakurikuler_mhs) ? route('ekstrakurikuler_mhs.update', $ekstrakurikuler_mhs->id) : route('ekstrakurikuler_mhs.store') }}" method="post">
                @csrf
                @isset($ekstrakurikuler_mhs) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Ekstrakurikuler</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="semester_id" class="col-md-3 col-form-label">Semester</label>
                                    <div class="col-md">
                                        <select name="semester_id" id="semester_id" class="form-control @error('semester_id') is-invalid @enderror">
                                            <option>{{ trans('ekstrakurikuler_mhs.placeholders.semester_id') }}</option>
                                            @foreach ($semester as $item)
                                            <option value="{{ $item->id }}"
                                                @php
                                                    if ($semester_id = $request->input('semester_id')) {
                                                        echo $semester_id == $item->id ? 'selected' : '';
                                                    } else {
                                                        echo isset($ekstrakurikuler_mhs) ? ($ekstrakurikuler_mhs->semester_id == $item->id ? 'selected' : '') :
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
                                    <label for="ekstrakurikuler_id" class="col-md-3 col-form-label">Ekstrakurikuler</label>
                                    <div class="col-md">
                                        <select name="ekstrakurikuler_id" id="ekstrakurikuler_id" class="form-control @error('ekstrakurikuler_id') is-invalid @enderror">
                                            <option>{{ trans('ekstrakurikuler_mhs.placeholders.ekstrakurikuler_id') }}</option>
                                            @foreach ($ekstrakurikuler as $item)
                                            <option value="{{ $item->id }}" {{ isset($ekstrakurikuler_mhs) ? ($ekstrakurikuler_mhs->ekstrakurikuler_id == $item->id ? 'selected' : '') : (old('semester_id') == $item->id ? 'selected' : '') }}>
                                                {{ $item->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('ekstrakurikuler_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jabatan" class="col-md-3 col-form-label">Jabatan</label>
                                    <div class="col-md">
                                        <select name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                                            <option>{{ trans('ekstrakurikuler_mhs.placeholders.jabatan') }}</option>
                                            @foreach (config('constants.forms.jabatan') as $jabatan)
                                            <option value="{{ $jabatan }}" {{ isset($ekstrakurikuler_mhs) ? ($ekstrakurikuler_mhs->jabatan == $jabatan ? 'selected' : '') : (old('jabatan') == $jabatan ? 'selected' : '') }}>
                                                {{ $jabatan }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('jabatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('ekstrakurikuler_mhs.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
