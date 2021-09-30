@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-meetings-list-component list_url="{{ route('api.inspector.meetings.list') }}" create_url="{{ route('inspector.meetings.create') }}"></inspector-meetings-list-component>
    </div>
@endsection
