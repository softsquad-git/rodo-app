@extends('layouts.inspector')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">

        <div class="row">
            <div class="col-md-8 col-12">
                <!-- update basic data-->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{ __('admin.settings.basic_data') }}</h3>
                    </div>

                    <div class="block-content block-content block-content-full">
                        <form method="post" action="{{ route('admin.update.basic_data') }}">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label for="first_name" class="form-label">{{ __('admin.settings.first_name') }}</label>
                                    <input type="text" value="{{ $user->first_name ? $user->first_name : old('first_name') }}" id="first_name" name="first_name" class="form-control">
                                    @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="last_name" class="form-label">{{ __('admin.settings.last_name') }}</label>
                                    <input type="text" value="{{ $user->last_name ? $user->last_name : old('last_name') }}" id="last_name" name="last_name" class="form-control">
                                    @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('admin.settings.email') }}</label>
                                    <input type="email" value="{{ $user->email ? $user->email : old('email') }}" id="email" name="email" class="form-control">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <button class="btn btn-sm btn-outline-primary" type="submit">Zapisz</button>
                                </div>
                            </div>
                        </form>

                        <form method="post" action="{{ route('admin.update.password') }}" class="mt-3">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label for="old_password" class="form-label">{{ __('admin.settings.old_password') }}</label>
                                    <input type="text" value="{{ old('old_password') }}" id="first_name" name="old_password" class="form-control">
                                    @error('old_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="new_password" class="form-label">{{ __('admin.settings.new_password') }}</label>
                                    <input type="text" value="{{ old('new_password') }}" id="new_password" name="new_password" class="form-control">
                                    @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <button class="btn btn-sm btn-outline-primary" type="submit">Zapisz</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end update basic data-->
            </div>
            <div class="col-md-4 col-12">
                <!--update avatar-->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{ __('admin.settings.avatar') }}</h3>
                    </div>

                    <div class="block-content block-content block-content-full">
                        <form method="POST" action="{{ route('admin.update.avatar') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="avatar" class="form-label">{{ __('admin.settings.change_avatar') }}</label>
                                <input class="form-control" type="file" id="avatar" name="avatar">
                                @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-outline-primary btn-sm"
                                        type="submit">{{ __('trans.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- edn update avatar-->
            </div>
        </div>

    </div>
@endsection
