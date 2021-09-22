@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="GET" action="" style="width: 150px">
                    <div class="mb-4">
                        <label class="form-label" for="type_account">{{ __('admin.users.form.type_account') }}</label>
                        <select id="type_account" class="form-control" name="role" onchange="this.form.submit()">
                            <option value="" selected>{{ __('trans.select') }}</option>
                            <option value="{{ \App\Helpers\Role::$role['INSPECTOR'] }}"{{ \App\Helpers\Role::$role['INSPECTOR'] == request()->input('role') ? 'selected' : '' }}>{{ __('trans.roles.'.\App\Helpers\Role::$role['INSPECTOR']) }}</option>
                            <option value="{{ \App\Helpers\Role::$role['EMPLOYEE'] }}"{{ \App\Helpers\Role::$role['EMPLOYEE'] == request()->input('role') ? 'selected' : '' }}>{{ __('trans.roles.'.\App\Helpers\Role::$role['EMPLOYEE']) }}</option>
                        </select>
                    </div>
                </form>

                @if(request()->input('role') && !empty(request()->input('role')))
                    @include('admin.users.partials.'.request()->input('role'))
                @endif
            </div>
        </div>
    </div>
@endsection
