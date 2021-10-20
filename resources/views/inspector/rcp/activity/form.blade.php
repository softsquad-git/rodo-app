@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="post"
                      action="{{ $item->id ? route('inspector.rcp.activity.update', ['id' => $item->id]) : route('inspector.rcp.activity.create') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="name" class="form-label">{{ __('inspector.rcp.activity.form.name') }}</label>
                            <input type="text" class="form-control" id="name" value="{{ $item->name ? $item->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="basic_processing" class="form-label">{{ __('inspector.rcp.activity.form.basic_processing') }}</label>
                            <input type="text" class="form-control" id="basic_processing" value="{{ $item->basic_processing ? $item->basic_processing : old('basic_processing') }}">
                            @error('basic_processing')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="status" class="form-label">{{ __('inspector.rcp.activity.form.status') }}</label>
                            <select id="status" class="form-control" name="status_id">
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
                        <div class="col-md-4 col-12">
                            <label for="datasets" class="form-label">Powiązane zbiory</label>
                            <select class="form-control js-example-basic-multiple" id="datasets" multiple name="datasets[]">
                                @foreach($datasets as $dataset)
                                    <option value="{{ $dataset->id }}">{{ $dataset->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" type="submit">{{ __('trans.save') }}</button>
                        <a href="{{ route('inspector.rcp.activity.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
