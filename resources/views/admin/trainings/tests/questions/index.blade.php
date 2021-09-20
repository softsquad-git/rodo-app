@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <admin-test-questions-list-component list_url="{{ route('api.admin.trainings.tests.questions.list') }}" create_url="{{ route('admin.trainings.test.questions.create') }}"></admin-test-questions-list-component>
    </div>
@endsection
