@extends('layouts.base')

@section('title', 'Lihat Semester - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('semester.index') }}">Semester</a></li>
    <li class="breadcrumb-item active">Lihat Semester</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-institution">
            </i>&nbsp;Lihat Semester</strong>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Data Semester</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="tahun_akademik" class="col-sm-3 col-form-label">Tahun Akademik</label>
                            <div class="col-sm-9">
                                <input type="text" name="tahun_akademik" id="tahun_akademik" class="form-control-plaintext" value="{{ $semester->tahun_akademik->nama }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tipe" class="col-sm-3 col-form-label">Tipe</label>
                            <div class="col-sm-9">
                                <input type="text" name="tipe" id="tipe" class="form-control-plaintext" value="{{ $semester->tipe }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-accent-primary">
                    <div class="card-header">
                        <strong class="text-primary">KRS</strong>
                        @empty($semester->krs)
                        <a href="{{ route('krs.create', ['semester_id' => $semester->id]) }}" class="btn btn-primary float-right">
                            <i class="cil-plus"></i> Tambah KRS
                        </a>
                        @endempty
                    </div>
                    <div class="card-body">
                        @if($krs = $semester->krs)
                        <table class="table table-bordered table-hover" width="100%" id="dataTable">
                            <thead>
                                <tr>
                                    <td>Jumlah SKS</td>
                                    <td>Catatan</td>
                                    <td>Bukti KRS</td>
                                    <td>Tanggal Dibuat</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $krs->jumlah }}</td>
                                    <td>{{ $krs->catatan ?: '-' }}</td>
                                    <td>
                                        @isset($krs->file_upload)
                                        <a href="{{ route('krs.view_upload', $krs->id) }}" class="btn btn-link">Lihat file</a>
                                        @else
                                        -
                                        @endisset
                                    </td>
                                    <td>{{ $krs->created_at }}</td>
                                    <td>
                                        @include('components.edit', ['url' => route('krs.edit', $krs->id)])
                                        @include('components.delete', ['url' => route('krs.destroy', $krs->id)])
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @else
                        <strong>Data tidak ditemukan!</strong>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
