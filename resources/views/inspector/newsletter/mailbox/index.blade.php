@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => ['inspector.newsletter.index' => 'Wiadomości']])
    <div id="app" class="content">
        <inspector-newsletter-mailbox-list-component list_url="{{ route('api.inspector.newsletter.list') }}" create_url="{{ route('inspector.newsletter.create') }}"></inspector-newsletter-mailbox-list-component>
    </div>
@endsection
