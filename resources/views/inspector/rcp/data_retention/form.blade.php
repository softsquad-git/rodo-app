@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="post"
                      action="{{ $item->id ? route('inspector.rcp.data_retention.update', ['id' => $item->id]) : route('inspector.rcp.data_retention.create') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-3 col-12">
                            <label for="name" class="form-label">{{ __('inspector.rcp.data_retention.form.name') }}</label>
                            <input type="text" class="form-control" id="name" value="{{ $item->name ? $item->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="count" class="form-label">{{ __('inspector.rcp.data_retention.form.count') }}</label>
                            <input type="number" class="form-control" id="count" value="{{ $item->count ? $item->count : old('count') }}">
                            @error('count')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="count" class="form-label">{{ __('inspector.rcp.data_retention.form.status') }}</label>
                            <select id="status" class="form-control" name="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"{{ $item->status_id ? ($item->status_id == $status->id ? 'selected' : '') : (old('status_id') == $status->id ? 'selected' : '') }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="row">
                                <div class="col-sm-4 col-4 pr-0">
                                    <label for="unit_day" class="form-label">Jednostka (dzień)</label>
                                    <input type="number" class="form-control" name="unit_day" id="unit_day">
                                </div>
                                <div class="col-sm-4 col-4 pl-0 pr-0">
                                    <label for="unit_month" class="form-label">Jednostka (miesiąc)</label>
                                    <input type="number" class="form-control" name="unit_month" id="unit_month">
                                </div>
                                <div class="col-sm-4 col-4 pl-0">
                                    <label for="unit_year" class="form-label">Jednostka (rok)</label>
                                    <input type="number" class="form-control" name="unit_year" id="unit_year">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" type="submit">{{ __('trans.save') }}</button>
                        <a href="{{ route('inspector.rcp.data_retention.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
