@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="post"
                      action="{{ $item->id ? route('inspector.risk_analysis.security.update', ['id' => $item->id]) : route('inspector.risk_analysis.security.create') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="name" class="form-label">{{ __('inspector.risk_analysis.security.form.name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $item->name ? $item->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="type" class="form-label">{{ __('inspector.risk_analysis.security.form.type') }}</label>
                            <select class="form-control" id="type" name="type_id">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"{{ $item->type_id ? ($item->type_id == $type->id ? 'selected' : '') : (old('type_id') == $type->id ? 'selected' : '') }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="status" class="form-label">{{ __('inspector.risk_analysis.security.form.status') }}</label>
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
                            <label for="description" class="form-label">{{ __('inspector.risk_analysis.security.form.description') }}</label>
                            <textarea id="description" class="editor" name="description">{{ $item->description ? $item->description : old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" type="submit">{{ __('trans.save') }}</button>
                        <a href="{{ route('inspector.risk_analysis.security.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
