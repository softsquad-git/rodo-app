@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <trainings-list-groups-component list_url="{{ route('api.admin.trainings.groups.list') }}" create_url="{{ route('admin.trainings.groups.create') }}"></trainings-list-groups-component>
    </div>
@endsection
