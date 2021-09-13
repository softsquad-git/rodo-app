@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="POST" action="{{ $item->id ? route('admin.trainings.update', ['id' => $item->id]) : route('admin.trainings.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <label class="col-form-label" for="name">{{ __('admin.trainings.form.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name ? $item->name : old('name') }}" placeholder="{{ __('admin.trainings.groups.form.name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label class="col-form-label mt-2" for="name">{{ __('admin.trainings.form.description') }}</label>
                            <textarea name="description" class="editor">{{ $item->description? $item->description : old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="col-form-label" for="name">{{ __('admin.trainings.form.group') }}</label>
                            <select multiple class="form-control js-example-basic-multiple" name="groups[]">
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>

                            <label class="col-form-label mt-2" for="name">{{ __('admin.trainings.form.file') }}</label>
                            <input type="file" class="form-control" name="file">
                            @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                {{ __('trans.save') }}
                            </button>
                            <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
