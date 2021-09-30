@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-rcp-activity-list-component list_url="{{ route('api.inspector.rcp.activity.list') }}" create_url="{{ route('inspector.rcp.activity.create') }}"></inspector-rcp-activity-list-component>
    </div>
@endsection
