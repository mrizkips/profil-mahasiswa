@extends('layouts.base')

@section('title', 'Dashboard - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-speedometer">
            </i>&nbsp;Dashboard</strong>
        </h3>
        <h4 class="mb-4">Selamat datang, {{ $user->profil_mhs->nama }}</h4>
        <div class="row">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $semester->count() }}</div>
                        <div>Semester Ditempuh</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('semester.index') }}" class="btn btn-outline-primary">Lebih lanjut</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $krs->count() }}</div>
                        <div>KRS Dilakukan</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('krs.index') }}" class="btn btn-outline-info">Lebih lanjut</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $ekstrakurikuler->count() }}</div>
                        <div>Ekstrakurikuler</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('ekstrakurikuler_mhs.index') }}" class="btn btn-outline-success">Lebih lanjut</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $sertifikasi->count() }}</div>
                        <div>Sertifikasi</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('sertifikasi.index') }}" class="btn btn-outline-warning">Lebih lanjut</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $kegiatan->count() }}</div>
                        <div>Kegiatan</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-danger">Lebih lanjut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
