@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => [0 => 'Zgłoszenia']])
    <div id="app" class="content">
        <inspector-applications-issues-list-component list_url="{{ route('api.inspector.applications.issues.list') }}" create_url="{{ route('inspector.applications.issues.create') }}"></inspector-applications-issues-list-component>
    </div>
@endsection
