@extends('layouts.auth')
@section('title', __('auth.login.title'))
@section('content')
    <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
        <div class="w-100">
            <!-- Header -->
            <div class="text-center mb-5">
                <p class="mb-3">
                    <img src="{{ asset('images/logo.png') }}" width="100px" alt="{{ config('app.name') }}">
                </p>
                <h1 class="fw-bold mb-2">
                    Zaloguj się
                </h1>
            </div>
            <!-- END Header -->
            <div class="row g-0 justify-content-center">
                <div class="col-sm-8 col-xl-4">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="text" class="form-control form-control-lg form-control-alt py-3" id="email" name="email" placeholder="E-mail">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control form-control-lg form-control-alt py-3" id="password" name="password" placeholder="Hasło">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                @if (Route::has('password.request'))
                                    <a class="text-muted fs-sm fw-medium d-block d-lg-inline-block mb-1" href="{{ route('password.request') }}">
                                        Przypomnij hasło
                                    </a>
                                @endif
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-alt-primary">
                                    <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Zaloguj
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <a href="" class="btn btn-primary btn-sm w-100">Zaloguj z Facebook</a>
                        </div>
                        <div class="col-md-6 col-12">
                            <a href="" class="btn btn-secondary btn-sm w-100">Zaloguj z Google</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Sign In Form -->
        </div>
    </div>
@endsection
