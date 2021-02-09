@extends('layouts.base')

@section('title', 'Dashboard - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Profil Mahasiswa</li>
@endsection

@php
    $profil_mhs = $mahasiswa->profil_mhs ?: null;
@endphp

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-user">
                </i>&nbsp;Profil Mahasiswa</strong>
            </h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('storage/'.$profil_mhs->pas_foto) }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <strong>Data Pribadi</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" id="nama" class="form-control-plaintext" value="{{ $profil_mhs->nama }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jen_kel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jen_kel" id="jen_kel" class="form-control-plaintext" value="{{ config("constants.forms.jen_kel.$profil_mhs->jen_kel") }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kabkota_lahir" class="col-sm-3 col-form-label">Kab/Kota Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" name="kabkota_lahir" id="kabkota_lahir" class="form-control-plaintext" value="{{ $profil_mhs->kabkota_lahir->nama }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control-plaintext" value="{{ date_format_id($profil_mhs->tgl_lahir) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="alamat" id="alamat" class="form-control-plaintext" value="{{ $profil_mhs->alamat }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pekerjaan" id="pekerjaan" class="form-control-plaintext" value="{{ $profil_mhs->pekerjaan->nama }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-3 col-form-label">No. HP</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_hp" id="no_hp" class="form-control-plaintext" value="{{ $profil_mhs->no_hp }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" id="email" class="form-control-plaintext" value="{{ $profil_mhs->email }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
