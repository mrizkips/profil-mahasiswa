@extends('layouts.base')

@section('title', 'Daftar Semester - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Daftar Semester</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-institution">
            </i>&nbsp;Daftar Semester</strong>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Daftar Semester</strong>
                        <a href="{{ route('semester.create') }}" class="btn btn-primary float-right">
                            <i class="cil-plus"></i> Tambah Semester
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" width="100%" id="dataTable">
                            <thead>
                                <tr>
                                    <td width="30px">#</td>
                                    <td>Tahun Akademik</td>
                                    <td>Tipe</td>
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
            ajax: "{{ route('semester.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'tahun_akademik.nama', name: 'tahun_akademik.nama'},
                {data: 'tipe', name: 'tipe'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['4', 'desc']
        });
    });
</script>
@endsection
