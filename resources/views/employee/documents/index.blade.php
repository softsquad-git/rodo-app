@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik']])
    <div id="app" class="content">
        <employee-documents-list-component list_url="{{ route('api.employee.documents.list') }}"></employee-documents-list-component>
    </div>
@endsection
