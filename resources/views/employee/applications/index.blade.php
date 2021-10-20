@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik']])
    <div id="app" class="content">
        <employee-applications-list-component list_url="{{ route('api.inspector.applications.issues.list') }}" create_url="{{ route('inspector.applications.issues.create') }}"></employee-applications-list-component>
    </div>
@endsection
