@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content" id="app">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <inspector-applications-issues-form-component save_url="{{ $item->id ? route('inspector.applications.issues.update', ['id' => $item->id]) : route('inspector.applications.issues.create') }}"
                                                    type="{{ $item->id ? 'edit' : 'create' }}"></inspector-applications-issues-form-component>
            </div>
        </div>
    </div>
@endsection
