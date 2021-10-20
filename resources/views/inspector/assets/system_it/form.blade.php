@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="post"
                      action="{{ $item->id ? route('inspector.assets.system_it.update', ['id' => $item->id]) : route('inspector.assets.system_it.create') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="name" class="form-label">{{ __('inspector.assets.system_it.form.name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $item->name ? $item->name : old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="owner" class="form-label">{{ __('inspector.assets.system_it.form.owner') }}</label>
                            <input type="text" class="form-control" name="owner" id="owner" value="{{ $item->owner ? $item->owner : old('owner') }}">
                            @error('owner')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="status" class="form-label">{{ __('inspector.assets.system_it.form.status') }}</label>
                            <select class="form-control" id="status" name="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"{{ $item->status_id ? ($item->status_id == $status->id ? 'selected' : '') : (old('status_id') == $status->id ? 'selected' : '') }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="description" class="form-label">{{ __('inspector.assets.system_it.form.description') }}</label>
                            <textarea id="description" class="editor" name="description">{{ $item->description ? $item->description : old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 col-12">
                            <label for="type" class="form-label">{{ __('inspector.assets.system_it.form.type') }}</label>
                            <select class="form-control" id="type" name="type_id">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"{{ $item->type_id ? ($item->type_id == $type->id ? 'selected' : '') : (old('type_id') == $type->id ? 'selected' : '') }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="form-label">{{ __('inspector.assets.system_it.form.security') }}</label>
                            @foreach($security as $key => $sec)
                                <label for="{{ $key }}" class="w-100"><input type="checkbox" id="{{ $key }}" name="security_ids[]" value="{{ $sec->id }}"> {{ $sec->name }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" type="submit">{{ __('trans.save') }}</button>
                        <a href="{{ route('inspector.assets.system_it.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
