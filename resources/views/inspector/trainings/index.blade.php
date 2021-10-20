@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div id="app" class="content">
        <inspector-trainings-list-component list_url="{{ route('api.inspector.trainings.list') }}"></inspector-trainings-list-component>
    </div>
@endsection
