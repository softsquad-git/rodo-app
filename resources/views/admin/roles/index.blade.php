@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <roles-list-component list_url="{{ route('api.admin.roles.list') }}" create_url="{{ route('admin.roles.create') }}"></roles-list-component>
    </div>
@endsection
