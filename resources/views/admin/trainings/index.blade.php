@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <trainings-list-component list_url="{{ route('api.admin.trainings.list') }}" create_url="{{ route('admin.trainings.create') }}"></trainings-list-component>
    </div>
@endsection
