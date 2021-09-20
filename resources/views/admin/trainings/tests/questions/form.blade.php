@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <admin-test-question-form-component type="{{ $item->id ? 'edit' : 'create' }}" save_url="{{ $item->id ? route('api.admin.trainings.tests.questions.update', ['id' => $item->id]) : route('api.admin.trainings.tests.questions.create') }}"></admin-test-question-form-component>
    </div>
@endsection
