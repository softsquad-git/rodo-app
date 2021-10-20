@extends('layouts.inspector')
@section('content')
    <div class="content">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2">
                    Witaj, <span class="fw-semibold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                </h1>
            </div>
            <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                <form method="POST" action="">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-text input-group-text-alt">
                          <i class="far fa-user"></i>
                        </span>
                        <select id="client" class="form-control form-control-sm" name="client_id" onchange="this.form.submit()">
                            <option value="null" selected>Wybierz firmę</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ Session::get('inspector_client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
