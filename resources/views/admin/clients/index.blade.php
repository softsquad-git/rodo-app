@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div id="app" class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <div class="block-title"></div>
                <div class="block-options">
                    <a href="{{ route('admin.clients.create') }}" title="Dodaj" class="btn-block-option float-right w-auto">
                        <i class="si si-plus"></i>
                    </a>
                </div>
            </div>

            <clients-list-component list_url="{{ route('api.admin.clients.list') }}"></clients-list-component>

        </div>
    </div>
@endsection
