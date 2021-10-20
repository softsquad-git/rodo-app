@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => [0 => 'Zgłoszenia']])
    <div id="app" class="content">
        <inspector-applications-incidents-list-component list_url="{{ route('api.inspector.applications.incidents.list') }}" create_url="{{ route('inspector.applications.incidents.create') }}"></inspector-applications-incidents-list-component>
    </div>
@endsection
