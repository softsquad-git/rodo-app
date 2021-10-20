@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')], 'pages' => [
    'admin.trainings.index' => 'Szkolenia',
]])
    <div id="app" class="content">
        <certificates-list-component list_url="{{ route('api.admin.certificates.list') }}"></certificates-list-component>
    </div>
@endsection
