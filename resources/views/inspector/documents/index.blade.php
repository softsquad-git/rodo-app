@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-documents-list-component list_url="{{ route('api.inspector.documents.list') }}" create_url="{{ route('inspector.documents.create') }}"></inspector-documents-list-component>
    </div>
@endsection
