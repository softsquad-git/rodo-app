@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="post"
                      action="{{ $item->id ? route('inspector.departments.update', ['id' => $item->id]) : route('inspector.departments.create') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <label class="form-label" for="name">{{ __('inspector.tasks.form.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $item->name ? $item->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label" for="name">{{ __('inspector.tasks.form.status') }}</label>
                            <select class="form-control @error('status_id') is-invalid @enderror" id="status" name="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" type="submit">{{ __('trans.save') }}</button>
                        <a href="{{ route('inspector.departments.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
