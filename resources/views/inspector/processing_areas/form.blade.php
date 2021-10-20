@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content" id="app">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="POST" action="{{$item->id ? route('inspector.processing_areas.update', ['id' => $item->id]) : route('inspector.processing_areas.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <label for="name" class="form-label">Nazwa</label>
                            <input type="text" id="name" class="form-control" name="name">
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="location" class="form-label">Obszar nadrzędny</label>
                            <select id="location" class="form-control" name="location_id">
                                <option value="" selected>Wybierz</option>
                                @foreach($processingAreas as $processingArea)
                                    <option value="{{ $processingArea->id }}">{{ $processingArea->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="security" class="form-label">Zabezpieczenia</label>
                            <select id="security" class="form-control js-example-basic-multiple" multiple="multiple" name="security_ids[]">
                                <option value="" selected>Wybierz</option>
                                @foreach($security as $sec)
                                    <option value="{{ $sec }}">{{ $sec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Zapisz</button>
                            <a href="{{ route('inspector.processing_areas.index') }}" class="btn btn-outline-danger btn-sm">Anuluj</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
