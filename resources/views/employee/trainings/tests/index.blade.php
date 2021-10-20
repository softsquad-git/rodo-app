@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik'], 'pages' => ['employee.trainings.index' => 'Szkolenia']])
    <div id="app" class="content">
        <employee-trainings-test-list-component list_url="{{ route('api.employee.trainings.tests.list') }}"></employee-trainings-test-list-component>
    </div>
@endsection
