@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => [0 => 'Zgłoszenia']])
    <div id="app" class="content">
        <inspector-applications-conclusions-list-component list_url="{{ route('api.inspector.applications.conclusions.list') }}" create_url="{{ route('inspector.applications.conclusions.create') }}"></inspector-applications-conclusions-list-component>
    </div>
@endsection
