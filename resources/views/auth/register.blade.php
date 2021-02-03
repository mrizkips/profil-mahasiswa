@extends('layouts.baseAuth')

@section('title', 'Registrasi Mahasiswa - '.config('app.name'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            @include('components.alert')
                            <div class="text-center">
                                <img src="{{ asset('assets/img/stmik-logo.png') }}" alt="STMIK Logo" class="text-center img-fluid mb-4" width="200px">
                            </div>
                            <h1>Registrasi</h1>
                            <p class="text-muted">Halaman registrasi untuk mahasiswa</p>
                            <form method="POST" action="{{ route('register') }}" novalidate>
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="cil-user"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('username') is-invalid @enderror" type="text" placeholder="{{ trans('auth.placeholders.nim') }}" name="{{'username'}}" value="{{ old('username') }}" required autofocus>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('login') }}" class="btn btn-link px-0">Login</a>
                                        <button class="btn btn-primary px-4 float-right" type="submit">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
