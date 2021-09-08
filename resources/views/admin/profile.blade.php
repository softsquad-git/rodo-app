@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => 'Administrator']])
    <div class="content">

        <div class="row">
            <div class="col-md-8 col-12">
                <!-- update basic data-->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{ __('admin.settings.basic_data') }}</h3>
                    </div>

                    <div class="block-content block-content block-content-full">

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
