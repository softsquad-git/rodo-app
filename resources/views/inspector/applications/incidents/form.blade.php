@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content" id="app">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <inspector-applications-incidents-form-component save_url="{{ $item->id ? route('inspector.applications.incidents.update', ['id' => $item->id]) : route('inspector.applications.incidents.create') }}"
                                                              type="{{ $item->id ? 'edit' : 'create' }}"></inspector-applications-incidents-form-component>
            </div>
        </div>
    </div>
@endsection
