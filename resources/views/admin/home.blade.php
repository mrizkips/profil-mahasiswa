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
        <h4 class="mb-4">Selamat datang, {{ $user->profil_admin->nama }}</h4>
        @if($active_tahun_akademik = $tahun_akademik->aktif()->first())
            <h5 class="mb-4">{{ "Tahun ajaran $active_tahun_akademik->nama" }}</h5>
        @endif
        <div class="row">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $mahasiswa->count() }}</div>
                        <div>Mahasiswa Terdaftar</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-outline-primary">Lebih lanjut</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $jurusan->count() }}</div>
                        <div>Jurusan Terdaftar</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.jurusan.index') }}" class="btn btn-outline-info">Lebih lanjut</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $tahun_akademik->count() }}</div>
                        <div>Jumlah Tahun Akademik</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.tahun_akademik.index') }}" class="btn btn-outline-success">Lebih lanjut</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="text-value-lg">{{ $ekstrakurikuler->count() }}</div>
                        <div>Jumlah Ekstrakurikuler</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-outline-warning">Lebih lanjut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
