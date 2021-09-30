@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content" id="app">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <inspector-datasets-form-component
                    save_url="{{ $item->id ? route('inspector.datasets.update', ['id' => $item->id]) : route('inspector.datasets.create') }}"
                    categories_data="{{ json_encode(\App\Models\DataSets\Dataset::$categoriesData) }}"
                    type="{{ $item->id ? 'edit' : 'create' }}"
                    processing="{{ json_encode(\App\Models\DataSets\Dataset::$processing) }}"
                >
                </inspector-datasets-form-component>
            </div>
        </div>
    </div>
@endsection
