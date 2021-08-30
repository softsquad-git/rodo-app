@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <settings-component
            url_settings_list="{{ route('api.admin.settings.list') }}"
            url_status_list="{{ route('api.admin.settings.status.list') }}"
            url_status_create="{{ route('api.admin.settings.status.create') }}"
            url_status_update="{{ route('api.admin.settings.status.update') }}"
            url_status_remove="{{ route('api.admin.settings.status.remove') }}"
            url_status_find="{{ route('api.admin.settings.status.find') }}"
        >
        </settings-component>
    </div>
@endsection
