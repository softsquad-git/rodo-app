@extends('layouts.auth')

@section('content')
    <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
        <div class="w-100">
            <!-- Header -->
            <div class="text-center mb-5">
                <p class="mb-3">
                    <img src="{{ asset('images/logo.png') }}" width="100px" alt="{{ config('app.name') }}">
                </p>
                <h1 class="fw-bold mb-2">
                    Przypomnij hasło
                </h1>
                <p class="fw-medium text-muted">
                    Podaj adres e-mail swojego konta, a my wyślemy Ci hasło.
                </p>
            </div>
            <!-- END Header -->

            <div class="row g-0 justify-content-center">
                <div class="col-sm-8 col-xl-4">
                    <form class="js-validation-reminder" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="email" class="form-control form-control-lg form-control-alt py-3" id="reminder_credential" name="email" value="{{ old('email') }}" placeholder="E-mail">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-alt-primary">
                                <i class="fa fa-fw fa-envelope me-1 opacity-50"></i> Wyślij
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Reminder Form -->
        </div>
    </div>
@endsection
