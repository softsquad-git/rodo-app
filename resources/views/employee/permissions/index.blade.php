@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik']])
    <div id="app" class="content">
        <employee-permissions-list-component list_url="{{ route('api.inspector.applications.issues.list') }}" create_url="{{ route('inspector.applications.issues.create') }}"></employee-permissions-list-component>
    </div>
@endsection
