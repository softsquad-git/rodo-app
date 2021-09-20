@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="POST"
                      action="{{ $item->id ? route('admin.trainings.tests.update', ['id' => $item->id]) : route('admin.trainings.tests.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <label class="col-form-label" for="name">{{ __('admin.trainings.tests.form.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $item->name ? $item->name : old('name') }}"
                                   placeholder="{{ __('admin.trainings.tests.form.name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="col-form-label"
                                   for="group">{{ __('admin.trainings.tests.form.group') }}</label>
                            <select class="form-control" id="group" name="group_id">
                                <option value="" selected>Wybierz</option>
                                @foreach($groups as $group)
                                    <option
                                        value="{{ $group->id }}"{{ $group->id == $item->group_id ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="col-form-label mt-2"
                                   for="name">{{ __('admin.trainings.form.description') }}</label>
                            <textarea name="description"
                                      class="editor">{{ $item->description? $item->description : old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label mt-2"
                                   for="name">{{ __('admin.trainings.tests.form.pass_threshold') }}</label>
                            <input type="number" class="form-control" name="pass_threshold" value="{{ $item->pass_threshold ? $item->pass_threshold : old('pass_threshold') }}">
                            @error('pass_threshold')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="col-form-label mt-2"
                                   for="name">{{ __('admin.trainings.tests.form.answers') }}</label>
                            <div>
                                <div class="space-y-2">
                                    @foreach($questions as $key => $q)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $q->id }}" id="{{ $key }}" name="questions[]">
                                            <label class="form-check-label" for="{{ $key }}">{{ $q->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                {{ __('trans.save') }}
                            </button>
                            <a href="{{ route('admin.trainings.tests.index') }}"
                               class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
