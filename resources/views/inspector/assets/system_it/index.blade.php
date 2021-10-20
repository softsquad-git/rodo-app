@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => [0 => 'Aktywa']])
    <div id="app" class="content">
        <inspector-assets-system-it-list-component list_url="{{ route('api.inspector.assets.system_it.list') }}" create_url="{{ route('inspector.assets.system_it.create') }}"></inspector-assets-system-it-list-component>
    </div>
@endsection
