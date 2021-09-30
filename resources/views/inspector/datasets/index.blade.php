@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-datasets-list-component list_url="{{ route('api.inspector.datasets.list') }}" create_url="{{ route('inspector.datasets.create') }}"></inspector-datasets-list-component>
    </div>
@endsection
