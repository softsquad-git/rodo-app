@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik'], 'pages' => ['employee.trainings.index' => 'Szkolenia']])
    <div id="app" class="content">
        <employee-trainings-certificates-list-component list_url="{{ route('api.employee.trainings.certificates.list') }}"></employee-trainings-certificates-list-component>
    </div>
@endsection
