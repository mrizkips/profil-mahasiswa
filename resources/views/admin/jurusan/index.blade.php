@extends('layouts.base')

@section('title', 'Daftar Jurusan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Jurusan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-bookmark">
                </i>&nbsp;Jurusan</strong>
            </h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Jurusan</strong>
                            <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Jurusan
                            </a>
                        </div>
                        <div class="card-body">
                            @isset($jurusan)
                            <table class="table table-bordered table-hover" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>Nama Jurusan</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurusan as $key => $data)
                                        <tr>
                                            <td>{{ $jurusan->firstItem() + $key }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                @include('components.edit', ['url' => route('admin.jurusan.edit', $data->id)])
                                                @include('components.delete', ['url' => route('admin.jurusan.destroy', $data->id)])
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                {{ $jurusan->links() }}
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
