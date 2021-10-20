@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik']])
    <div id="app" class="content">
        <employee-trainings-list-component list_url="{{ route('api.employee.trainings.list') }}"></employee-trainings-list-component>
    </div>
@endsection
