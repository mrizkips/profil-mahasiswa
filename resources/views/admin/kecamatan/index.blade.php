@extends('layouts.base')

@section('title', 'Daftar Kecamatan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item">Wilayah</li>
    <li class="breadcrumb-item active">Kecamatan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-map">
                </i>&nbsp;Kecamatan</strong>
            </h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Kecamatan</strong>
                            <a href="{{ route('admin.kecamatan.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Kecamatan
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>Nama Kecamatan</td>
                                        <td>Nama Kabupaten/Kota</td>
                                        <td>Aksi</td>
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
            ajax: "{{ route('admin.kecamatan.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama', name: 'nama'},
                {data: 'kabkota.nama', name: 'kabkota.nama', searchable: false},
                {data: 'action', name: 'action', 'searchable': false, orderable: false}
            ]
        });
    });
</script>
@endsection
