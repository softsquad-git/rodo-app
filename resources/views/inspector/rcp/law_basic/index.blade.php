@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => [0 => 'RCP']])
    <div id="app" class="content">
        <inspector-rcp-law-basic-list-component list_url="{{ route('api.inspector.rcp.law_basic.list') }}" create_url="{{ route('inspector.rcp.law_basic.create') }}"></inspector-rcp-law-basic-list-component>
    </div>
@endsection
