@extends('layouts.base')

@section('title', 'Daftar Sertifikasi - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Daftar Sertifikasi</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-school">
            </i>&nbsp;Daftar Sertifikasi</strong>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Daftar Sertifikasi</strong>
                        <a href="{{ route('sertifikasi.create') }}" class="btn btn-primary float-right">
                            <i class="cil-plus"></i> Tambah Sertifikasi
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>Tahun Akademik</td>
                                        <td>Tipe</td>
                                        <td>Nama</td>
                                        <td>Lembaga</td>
                                        <td>Nilai</td>
                                        <td>Catatan</td>
                                        <td>Bukti Sertifikasi</td>
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
            ajax: "{{ route('sertifikasi.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'semester.tahun_akademik.nama', name: 'semester.tahun_akademik.nama'},
                {data: 'semester.tipe', name: 'semester.tipe'},
                {data: 'nama', name: 'nama'},
                {data: 'lembaga', name: 'lembaga'},
                {data: 'nilai', name: 'nilai'},
                {data: 'catatan', name: 'catatan'},
                {data: 'view_upload', name: 'view_upload', searchable: false, orderable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['8', 'desc']
        });
    });
</script>
@endsection
