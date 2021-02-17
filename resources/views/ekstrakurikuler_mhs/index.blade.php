@extends('layouts.base')

@section('title', 'Daftar Ekstrakurikuler - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Daftar Ekstrakurikuler</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-basketball">
            </i>&nbsp;Daftar Ekstrakurikuler</strong>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Daftar Ekstrakurikuler</strong>
                        <a href="{{ route('ekstrakurikuler_mhs.create') }}" class="btn btn-primary float-right">
                            <i class="cil-plus"></i> Tambah Ekstrakurikuler
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" width="100%" id="dataTable">
                            <thead>
                                <tr>
                                    <td width="30px">#</td>
                                    <td>Tahun Akademik</td>
                                    <td>Tipe</td>
                                    <td>Nama Ekstrakurikuler</td>
                                    <td>Jabatan</td>
                                    <td>Tanggal Dibuat</td>
                                    <td class="text-center">Aksi</td>
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
            language: {
                url: '{{ asset('js/dataTables.indonesian.json') }}'
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('ekstrakurikuler_mhs.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'semester.tahun_akademik.nama', name: 'semester.tahun_akademik.nama'},
                {data: 'semester.tipe', name: 'semester.tipe'},
                {data: 'ekstrakurikuler.nama', name: 'ekstrakurikuler.nama'},
                {data: 'jabatan', name: 'jabatan'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['5', 'desc']
        });
    });
</script>
@endsection
