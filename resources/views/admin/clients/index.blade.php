@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <clients-list-component list_url="{{ route('api.admin.clients.list') }}" create_url="{{ route('admin.clients.create') }}"></clients-list-component>
    </div>
@endsection
