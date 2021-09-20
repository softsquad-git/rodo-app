@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <certificates-patters-list-component list_url="{{ route('api.admin.certificates.patters.list') }}" create_url="{{ route('admin.certificates.patters.create') }}"></certificates-patters-list-component>
    </div>
@endsection
