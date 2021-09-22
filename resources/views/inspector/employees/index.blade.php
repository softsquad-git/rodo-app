@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-employees-list-component list_url="{{ route('api.inspector.employees.list') }}" create_url="{{ route('inspector.employees.create') }}"></inspector-employees-list-component>
    </div>
@endsection
