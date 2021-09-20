@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <invoices-list-component list_url="{{ route('api.admin.invoices.list') }}"></invoices-list-component>
    </div>
@endsection
