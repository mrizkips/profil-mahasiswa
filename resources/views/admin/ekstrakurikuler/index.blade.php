@extends('layouts.base')

@section('title', 'Daftar Ekstrakurikuler - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Ekstrakurikuler</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-basketball">
                </i>&nbsp;Ekstrakurikuler</strong>
            </h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Ekstrakurikuler</strong>
                            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Ekstrakurikuler
                            </a>
                        </div>
                        <div class="card-body">
                            @isset($ekstrakurikuler)
                            <table class="table table-bordered table-hover" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>Nama Ekstrakurikuler</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ekstrakurikuler as $key => $data)
                                        <tr>
                                            <td>{{ $ekstrakurikuler->firstItem() + $key }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                @include('components.edit', ['url' => route('admin.ekstrakurikuler.edit', $data->id)])
                                                @include('components.delete', ['url' => route('admin.ekstrakurikuler.destroy', $data->id)])
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                {{ $ekstrakurikuler->links() }}
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
