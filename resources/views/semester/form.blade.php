@extends('layouts.base')

@section('title', isset($semester) ? 'Edit Semester - '.config('app.name') : 'Tambah Semester - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('semester.index') }}">Semester</a></li>
    <li class="breadcrumb-item active">{{ isset($semester) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-institution">
                </i>&nbsp;Semester</strong>&nbsp;<small>Form {{ isset($semester) ? 'Edit' : 'Tambah' }}</small>
            </h3>
            <form class="form-horizontal" action="{{ isset($semester) ? route('semester.update', $semester->id) : route('semester.store') }}" method="post">
                @csrf
                @isset($semester) @method('PUT') @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-accent-primary">
                            <div class="card-header"><strong class="text-primary">Input Data Semester</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tipe" class="col-md-3 col-form-label">Tipe</label>
                                    <div class="col-md">
                                        <select name="tipe" id="tipe" class="form-control @error('tipe') is-invalid @enderror">
                                            <option>Pilih Tipe</option>
                                            @foreach (config('constants.forms.semester') as $item)
                                            <option value="{{ $item }}" {{ isset($semester) ? ($semester->tipe == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @error('tipe')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tahun_akademik_id" class="col-md-3 col-form-label">Tahun Akademik</label>
                                    <div class="col-md">
                                        <select name="tahun_akademik_id" id="tahun_akademik_id" class="form-control @error('tahun_akademik_id') is-invalid @enderror">
                                            <option>Pilih Tahun Akademik</option>
                                            @isset($tahun_akademik)
                                                @foreach ($tahun_akademik as $item)
                                                <option value="{{ $item->id }}" {{ isset($semester) ? ($semester->tahun_akademik_id == $item->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        @error('tahun_akademik_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('semester.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
