@extends('layouts.baseAuth')

@php
    function isLoginRoute() {
        if (Route::currentRouteName() == 'login') {
            return true;
        }
        return false;
    }
@endphp

@section('title', isLoginRoute() ? 'Login Mahasiswa - '.config('app.name') : 'Login Admin - '.config('app.name'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-{{ isLoginRoute() ? '8' : '5' }}">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            @include('components.alert')
                            <div class="text-center">
                                <img src="{{ asset('assets/img/stmik-logo.png') }}" alt="STMIK Logo" class="text-center img-fluid mb-4" width="200px">
                            </div>
                            <h1>Login</h1>
                            <p class="text-muted">{{ $title }}</p>
                            <form method="POST" action="{{ route($loginRoute) }}" novalidate>
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="cil-user"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error($username) is-invalid @enderror" type="text" placeholder="Username" name="{{$username}}" value="{{ old($username) }}" required autofocus>
                                        @error($username)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="cil-lock-locked"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group float-right">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    Ingat Saya
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if (isLoginRoute())
                                        <a href="{{ route('admin.login') }}" class="btn btn-link px-0">Admin</a>
                                        @else
                                        <a href="{{ route('login') }}" class="btn btn-link px-0">Mahasiswa</a>
                                        @endif
                                        <button class="btn btn-{{$btnColor}} px-4 float-right" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (isLoginRoute())
                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>Registrasi</h2>
                                <p>Lakukan registrasi jika belum mempunyai akun.</p>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary active mt-3" type="button">Registrasi</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
