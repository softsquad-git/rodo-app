@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-departments-list-component list_url="{{ route('api.inspector.departments.list') }}" create_url="{{ route('inspector.departments.create') }}"></inspector-departments-list-component>
    </div>
@endsection
