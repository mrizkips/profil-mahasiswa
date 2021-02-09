@extends('layouts.base')

@section('title', 'Dashboard - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Ganti Password</li>
@endsection

@php
    $profil_mhs = $mahasiswa->profil_mhs ?: null;
@endphp

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-settings">
                </i>&nbsp;Ganti Password</strong>
            </h3>
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Ganti Password Form</strong></div>
                        <form action="{{ route('ganti_password.update') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="old_password" class="col-sm col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    @include('components.input', [
                                        'type' => 'password',
                                        'name' => 'old_password',
                                        'value' => old('old_password'),
                                        'required' => true,
                                        'autofocus' => true,
                                        'placeholder' => trans('passwords.placeholders.old_password'),
                                    ])
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    @include('components.input', [
                                        'type' => 'password',
                                        'name' => 'password',
                                        'value' => old('password'),
                                        'required' => true,
                                        'autofocus' => false,
                                        'placeholder' => trans('passwords.placeholders.password'),
                                    ])
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Password harus minimal 6 karakter.
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm col-form-label">Konfirmasi Password</label>
                                <div class="col-sm-9">
                                    @include('components.input', [
                                        'type' => 'password',
                                        'name' => 'password_confirmation',
                                        'value' => old('password_confirmation'),
                                        'required' => true,
                                        'autofocus' => false,
                                        'placeholder' => trans('passwords.placeholders.password_confirmation'),
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary"><i class="cil-send"></i> Kirim</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
