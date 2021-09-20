@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <admin-tests-list-component list_url="{{ route('api.admin.trainings.tests.list') }}" create_url="{{ route('admin.trainings.tests.create') }}" questions_list="{{ route('admin.trainings.tests.questions.index') }}"></admin-tests-list-component>
    </div>
@endsection
