@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card {
        background: #fff;
        border-radius: 12px;
        padding: 35px 30px;
        box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
    }

    .login-header {
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

    .form-check-label {
        font-weight: 500;
        color: #555;
    }

    .forgot-password {
        text-align: center;
        display: block;
        margin-top: 15px;
        color: #03ac0e;
        font-weight: 500;
    }

    .forgot-password:hover {
        color: #02940d;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-5">
        <div class="card login-card">
            <div class="login-header">Login PintuDagang</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus>
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

                    <div class="form-group form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>

                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
