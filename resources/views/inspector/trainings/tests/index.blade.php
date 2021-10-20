@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => ['inspector.trainings.index' => 'Szkolenia']])
    <div id="app" class="content">
        <inspector-trainings-tests-list-component list_url="{{ route('api.inspector.trainings.tests.list') }}"></inspector-trainings-tests-list-component>
    </div>
@endsection
