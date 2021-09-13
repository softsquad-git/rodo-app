@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="POST" action="{{ $item->id ? route('admin.trainings.groups.update', ['id' => $item->id]) : route('admin.trainings.groups.create') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4 col-12">
                            <label class="col-form-label" for="name">{{ __('admin.trainings.groups.form.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name ? $item->name : old('name') }}" placeholder="{{ __('admin.trainings.groups.form.name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        {{ __('trans.save') }}
                    </button>
                    <a href="{{ route('admin.trainings.groups.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
