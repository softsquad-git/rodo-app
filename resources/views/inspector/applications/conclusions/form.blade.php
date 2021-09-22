@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="post"
                      action="{{ $item->id ? route('inspector.applications.conclusions.update', ['id' => $item->id]) : route('inspector.applications.conclusions.create') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="title" class="form-label">{{ __('inspector.applications.conclusions.form.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{{ $item->title ? $item->title : old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="name" class="form-label">{{ __('inspector.applications.conclusions.form.name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $item->name ? $item->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="type" class="form-label">{{ __('inspector.applications.conclusions.form.type') }}</label>
                            <select class="form-control" id="type" name="type_id">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"{{ $item->type_id == $type->id ? 'selected' : (old('type_id') == $type->id ? 'selected' : '') }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="date_application" class="form-label">{{ __('inspector.applications.conclusions.form.date_application') }}</label>
                            <input type="datetime-local" step="1" class="form-control" value="{{ \Illuminate\Support\Carbon::now()->format('Y-m-d\TH:i:s') }}" disabled>
                            @error('date_application')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="content" class="form-label">{{ __('inspector.applications.conclusions.form.content') }}</label>
                            <textarea id="content" name="content" class="form-control form-control-alt" rows="4">{{ $item->content ? $item->content : old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-2 col-12">
                            <label for="status" class="form-label">{{ __('inspector.applications.conclusions.form.status') }}</label>
                            <select class="form-control" id="status" name="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"{{ $item->status_id == $status->id ? 'selected' : (old('status_id') == $status->id ? 'selected' : '') }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="employee" class="form-label">{{ __('inspector.applications.conclusions.form.employee_accepted') }}</label>
                            <select class="form-control" id="employee" name="accepted_employee_id">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}"{{ $item->accepted_employee_id == $employee->id ? 'selected' : (old('accepted_employee_id') == $employee->id ? 'selected' : '') }}>{{ $employee->user?->name }}</option>
                                @endforeach
                            </select>
                            @error('accepted_employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-7 col-12">
                            <label for="file" class="form-label">{{ __('inspector.applications.conclusions.form.file') }}</label>
                            <input type="file" class="form-control" name="file" id="file">
                            @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" type="submit">{{ __('trans.save') }}</button>
                        <a href="{{ route('inspector.applications.conclusions.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
