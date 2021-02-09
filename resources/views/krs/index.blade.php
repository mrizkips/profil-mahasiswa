@extends('layouts.base')

@section('title', 'Daftar KRS - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Daftar KRS</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-institution">
            </i>&nbsp;Daftar KRS</strong>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Daftar KRS</strong>
                        <a href="{{ route('krs.create') }}" class="btn btn-primary float-right">
                            <i class="cil-plus"></i> Tambah KRS
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" width="100%" id="dataTable">
                            <thead>
                                <tr>
                                    <td width="30px">#</td>
                                    <td>Tahun Akademik</td>
                                    <td>Tipe</td>
                                    <td>Jumlah</td>
                                    <td>Catatan</td>
                                    <td>Bukti KRS</td>
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
            ajax: "{{ route('krs.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'semester.tahun_akademik.nama', name: 'semester.tahun_akademik.nama'},
                {data: 'semester.tipe', name: 'semester.tipe'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'catatan', name: 'catatan'},
                {data: 'view_upload', name: 'view_upload', searchable: false, orderable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['6', 'desc']
        });
    });
</script>
@endsection
