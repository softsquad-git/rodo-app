@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor'], 'pages' => [0 => 'Analiza ryzyka']])
    <div id="app" class="content">
        <inspector-risk-analysis-security-list-component types="{{ json_encode($types) }}" list_url="{{ route('api.inspector.risk_analysis.security.list') }}" create_url="{{ route('inspector.risk_analysis.security.create') }}"></inspector-risk-analysis-security-list-component>
    </div>
@endsection
