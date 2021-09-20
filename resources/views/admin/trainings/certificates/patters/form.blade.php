@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="POST"
                      action="{{ $item->id ? route('admin.certificates.patters.update', ['id' => $item->id]) : route('admin.certificates.patters.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <label for="name" class="form-label">{{ __('admin.trainings.certificates.patters.form.name') }}</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $item->name ? $item->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="status" class="form-label">{{ __('admin.trainings.certificates.patters.form.status') }}</label>
                            <select id="status" class="form-control" name="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-9 col-12">
                            <label for="description" class="form-label">{{ __('admin.trainings.certificates.patters.form.description') }}</label>
                            <textarea name="description" class="editor">{{ $item->description? $item->description : old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="form-label w-100">Zmienne</label>
                            [CLIENT_NAME] <br/>
                            [CLIENT_ADDRESS] <br/>
                            [CLIENT_NIP] <br/>
                            [EMPLOYEE_FIRST_NAME] <br/>
                            [EMPLOYEE_LAST_NAME] <br/>
                            [EMPLOYEE_POSITION] <br/>
                            [TEST_DATE] <br/>
                            [TEST_NAME] <br/>
                            [TEST_DESCRIPTION]
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 col-12">
                            <label for="tests" class="form-label">{{ __('admin.trainings.certificates.patters.form.tests') }}</label>
                            <select id="tests" class="form-control" name="test_ids[]">
                                @foreach($tests as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('test_ids')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                {{ __('trans.save') }}
                            </button>
                            <a href="{{ route('admin.certificates.patters.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
