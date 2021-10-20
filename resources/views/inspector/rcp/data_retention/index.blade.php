@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => [0 => 'RCP']])
    <div id="app" class="content">
        <inspector-rcp-data-retention-list-component list_url="{{ route('api.inspector.rcp.data_retention.list') }}" create_url="{{ route('inspector.rcp.data_retention.create') }}"></inspector-rcp-data-retention-list-component>
    </div>
@endsection
