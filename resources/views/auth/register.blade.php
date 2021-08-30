@extends('layouts.auth')
@section('title', __('auth.register.title'))
@section('content')
    <div class="row justify-content-center push">
        <div class="col-md-8 col-lg-6 col-xl-4">
            <div class="block block-rounded mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('auth.register.title') }}</h3>
                    <div class="block-options">
                        <a class="btn-block-option fs-sm" href="javascript:void(0)" data-bs-toggle="modal">{{ __('auth.register.terms') }}</a>
                        <a class="btn-block-option" href="{{ route('login') }}" data-bs-toggle="tooltip" data-bs-placement="left" title="{{ __('auth.login.title') }}">
                            <i class="fa fa-sign-in-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="block-content">
                    <div class="p-sm-3 px-lg-3 px-xxl-3 py-lg-3">
                        <h1 class="h2 mb-1">{{ $setting['app_name'] }}</h1>
                        <p class="fw-medium text-muted">
                            {{ __('auth.register.welcome') }}
                        </p>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="py-2">
                                <div class="mb-3 row">
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" class="form-control form-control-lg form-control-alt" id="first_name" name="first_name" placeholder="{{ __('auth.form.first_name') }}" aria-label="{{ __('auth.form.first_name') }}">
                                        @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" class="form-control form-control-lg form-control-alt" id="last_name" name="last_name" placeholder="{{ __('auth.form.last_name') }}" aria-label="{{ __('auth.form.last_name') }}">
                                        @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email" placeholder="{{ __('auth.form.email') }}" aria-label="{{ __('auth.form.email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control form-control-lg form-control-alt" name="password" placeholder="{{ __('auth.form.password') }}" aria-label="{{ __('auth.form.password') }}">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control form-control-lg form-control-alt" name="" placeholder="{{ __('auth.form.confirm_password') }}" aria-label="{{ __('auth.form.confirm_password') }}">
                                </div>
                                <div class="mb-3">
                                    <small>{{ __('auth.register.accept_terms') }}</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn w-100 btn-alt-success">
                                        <i class="fa fa-fw fa-plus me-1 opacity-50"></i> {{ __('auth.register.title') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- END Sign Up Form -->
                    </div>
                </div>
            </div>
            <!-- END Sign Up Block -->
        </div>
    </div>
@endsection
