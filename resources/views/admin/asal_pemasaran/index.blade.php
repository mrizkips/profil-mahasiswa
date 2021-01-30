@extends('layouts.base')

@section('title', 'Daftar Asal Pemasaran - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Asal Pemasaran</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-chart-line">
                </i>&nbsp;Asal Pemasaran</strong>
            </h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Asal Pemasaran</strong>
                            <a href="{{ route('admin.asal_pemasaran.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Asal Pemasaran
                            </a>
                        </div>
                        <div class="card-body">
                            @isset($asal_pemasaran)
                            <table class="table table-bordered table-hover" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>Nama Asal Pemasaran</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asal_pemasaran as $key => $data)
                                        <tr>
                                            <td>{{ $asal_pemasaran->firstItem() + $key }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                @include('components.edit', ['url' => route('admin.asal_pemasaran.edit', $data->id)])
                                                @include('components.delete', ['url' => route('admin.asal_pemasaran.destroy', $data->id)])
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                {{ $asal_pemasaran->links() }}
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
