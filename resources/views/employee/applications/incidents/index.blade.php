@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik'], 'pages' => ['employee.applications.index' => 'Zgłoszenia']])
    <div id="app" class="content">
        <employee-applications-incidents-component list_url="{{ route('api.inspector.applications.issues.list') }}" create_url="{{ route('inspector.applications.issues.create') }}"></employee-applications-incidents-component>
    </div>
@endsection
