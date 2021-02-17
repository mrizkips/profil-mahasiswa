@extends('layouts.base')

@section('title', 'Daftar Tahun Akademik - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Tahun Akademik</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-institution">
                </i>&nbsp;Tahun Akademik</strong>
            </h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Tahun Akademik</strong>
                            <a href="{{ route('admin.tahun_akademik.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Tahun Akademik
                            </a>
                        </div>
                        <div class="card-body">
                            @isset($tahun_akademik)
                            <table class="table table-bordered table-hover" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>Nama Tahun Akademik</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tahun_akademik as $key => $data)
                                        <tr>
                                            <td>{{ $tahun_akademik->firstItem() + $key }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                @if ($data->aktif != 1)
                                                <form class="d-inline" action="{{ route('admin.tahun_akademik.aktif', $data->id) }}" method="post" onsubmit="return confirm('Apakah Anda yakin akan melakukan aksi ini?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-outline-info btn-sm" title="Aktifkan"><i class="cil-check"></i></button>
                                                </form>
                                                @endif
                                                @include('components.edit', ['url' => route('admin.tahun_akademik.edit', $data->id)])
                                                @include('components.delete', ['url' => route('admin.tahun_akademik.destroy', $data->id)])
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                {{ $tahun_akademik->links() }}
                            </nav>
                            @else
                            <strong>Data tidak ditemukan!</strong>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
