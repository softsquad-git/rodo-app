@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')], 'pages' => [
    'admin.invoices.index' => 'Faktury',
]])
    <div id="app" class="content">
        <invoices-settings-list-component list_url="{{ route('api.admin.invoices.settings.list') }}"></invoices-settings-list-component>
    </div>
@endsection
