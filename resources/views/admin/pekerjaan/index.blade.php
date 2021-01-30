@extends('layouts.base')

@section('title', 'Daftar Pekerjaan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Pekerjaan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-watch">
                </i>&nbsp;Pekerjaan</strong>
            </h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Pekerjaan</strong>
                            <a href="{{ route('admin.pekerjaan.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Pekerjaan
                            </a>
                        </div>
                        <div class="card-body">
                            @isset($pekerjaan)
                            <table class="table table-bordered table-hover" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>Nama Pekerjaan</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pekerjaan as $key => $data)
                                        <tr>
                                            <td>{{ $pekerjaan->firstItem() + $key }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                @include('components.edit', ['url' => route('admin.pekerjaan.edit', $data->id)])
                                                @include('components.delete', ['url' => route('admin.pekerjaan.destroy', $data->id)])
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                {{ $pekerjaan->links() }}
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
