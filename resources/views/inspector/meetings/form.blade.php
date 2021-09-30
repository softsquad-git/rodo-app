@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content" id="app">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <inspector-meetings-form-component save_url="{{ $item->id ? route('inspector.meetings.update', ['id' => $item->id]) : route('inspector.meetings.create') }}"
                                                                 type="{{ $item->id ? 'edit' : 'create' }}"></inspector-meetings-form-component>
            </div>
        </div>
    </div>
@endsection
