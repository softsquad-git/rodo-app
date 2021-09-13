@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-tasks-list-component list_url="{{ route('api.inspector.tasks.list') }}" create_url="{{ route('inspector.tasks.create') }}"></inspector-tasks-list-component>
    </div>
@endsection
