@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => [0 => 'Aktywa']])
    <div id="app" class="content">
        <inspector-assets-resources-list-component list_url="{{ route('api.inspector.assets.resources.list') }}" create_url="{{ route('inspector.assets.resources.create') }}"></inspector-assets-resources-list-component>
    </div>
@endsection
