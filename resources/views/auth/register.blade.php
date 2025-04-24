@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .register-card {
        background: #fff;
        border-radius: 12px;
        padding: 35px 30px;
        box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
    }

    .register-header {
        font-size: 26px;
        font-weight: bold;
        color: #03ac0e;
        text-align: center;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .btn-primary {
        background-color: #03ac0e;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px;
        width: 100%;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #02940d;
    }

    .login-link {
        text-align: center;
        display: block;
        margin-top: 15px;
        color: #03ac0e;
        font-weight: 500;
    }

    .login-link:hover {
        color: #02940d;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-5">
        <div class="card register-card">
            <div class="register-header">Daftar Tokopediaku</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback d-block mt-1 text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback d-block mt-1 text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required>
                        @error('password')
                            <span class="invalid-feedback d-block mt-1 text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <input id="password-confirm" type="password"
                               class="form-control"
                               name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Daftar</button>

                    <a class="login-link" href="{{ route('login') }}">
                        Sudah punya akun? Login di sini
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
