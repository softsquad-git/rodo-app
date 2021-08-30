@extends('layouts.auth')
@section('title', __('auth.login.title'))
@section('content')
    <div class="row justify-content-center push">
        <div class="col-md-8 col-lg-6 col-xl-4">
            <div class="block block-rounded mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('auth.login.title') }}</h3>
                    <div class="block-options">
                        <a class="btn-block-option fs-sm" href="">{{ __('auth.login.forgot_password') }}</a>
                        <a class="btn-block-option" href="{{ route('register') }}" data-bs-toggle="tooltip" data-bs-placement="left" title="{{ __('auth.register.title') }}">
                            <i class="fa fa-user-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="block-content">
                    <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                        <h1 class="h2 mb-1">{{ $setting['app_name'] }}</h1>
                        <p class="fw-medium text-muted">
                            {{ __('auth.login.welcome') }}
                        </p>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="py-3">
                                <div class="mb-4">
                                    <input type="text" class="form-control form-control-alt form-control-lg" id="login-username" name="email" value="{{ old('email') }}" placeholder="{{ __('auth.form.email') }}" aria-label="{{ __('auth.form.email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <input type="password" class="form-control form-control-alt form-control-lg" id="login-password" name="password" placeholder="{{ __('auth.form.password') }}" aria-label="{{ __('auth.form.password') }}">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="login-remember" name="login-remember">
                                        <label class="form-check-label" for="login-remember">{{ __('auth.login.remember_me') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn w-100 btn-alt-primary">
                                        <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> {{ __('auth.login.title') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
