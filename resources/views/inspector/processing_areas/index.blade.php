@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-processing-areas-list-component list_url="{{ route('api.inspector.processing_areas.list') }}" create_url="{{ route('inspector.processing_areas.create') }}"></inspector-processing-areas-list-component>
    </div>
@endsection
