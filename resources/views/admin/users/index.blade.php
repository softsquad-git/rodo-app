@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <users-list-component list_url="{{ route('api.admin.users.list') }}" create_url="{{ route('admin.users.create') }}"></users-list-component>
    </div>
@endsection
