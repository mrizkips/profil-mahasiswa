@extends('layouts.base')

@section('title', 'Daftar Mahasiswa - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Mahasiswa</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-people"></i>&nbsp;Mahasiswa</strong></h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Mahasiswa</strong>
                            <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Mahasiswa
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>NIM</td>
                                        <td>Nama</td>
                                        <td>Jurusan</td>
                                        <td>Tahun Masuk</td>
                                        <td class="action">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            'language': {
                url: '{{ asset('js/dataTables.indonesian.json') }}'
            },
            'columns': [
                { 'searchable': false },
                null,
                null,
                null,
                null,
                { 'searchable': false, orderable: false }
            ]
        });
    });
</script>
@endsection
