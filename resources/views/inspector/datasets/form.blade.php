@extends('layouts.inspector')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="POST"
                      action="{{ $item->id ? route('inspector.datasets.update', ['id' => $item->id]) : route('inspector.datasets.create') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="name" class="form-label">Nazwa</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="type" class="form-label">Typ</label>
                            <select id="type" class="form-control" name="type_id">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="type2" class="form-label">Rodzaj</label>
                            <select id="type2" class="form-control" name="type_2_id">
                                @foreach($types2 as $type2)
                                    <option value="{{ $type2->id }}">{{ $type2->name }}</option>
                                @endforeach
                            </select>
                            @error('type_2_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-control" name="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 col-12">
                            <label for="category_people" class="form-label">Kategoria osób</label>
                            <select class="form-control" id="category_people" name="category_people_id">
                                @foreach($categoriesPeople as $categoryPeople)
                                    <option value="{{ $categoryPeople->id }}">{{ $categoryPeople->name }}</option>
                                @endforeach
                            </select>
                            @error('category_people_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="category_data" class="form-label">Kategoria danych</label>
                            <select class="form-control" id="category_data" name="category_data">
                                @foreach(\App\Models\DataSets\Dataset::$categoriesData as $categoryData)
                                    <option value="{{ $categoryData }}">{{ $categoryData }}</option>
                                @endforeach
                            </select>
                            @error('category_data')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="content" class="form-label">Opis zbioru</label>
                            <textarea id="content" class="editor" name="description"></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 col-12">
                            <label for="areas_processing" class="form-label">Obszary przetwarzania</label>
                            <select id="areas_processing" class="form-control js-example-basic-multiple" name="area_processing_ids[]"
                                    multiple="multiple">
                                @foreach($processingAreas as $processingArea)
                                    <option value="{{ $processingArea->id }}">{{ $processingArea->name }}</option>
                                @endforeach
                            </select>
                            @error('area_processing_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="system_it" class="form-label">System IT</label>
                            <select id="system_id" class="form-control js-example-basic-multiple" name="system_ids[]" multiple="multiple">
                                @foreach($systemsIt as $systemIt)
                                    <option value="{{ $systemIt->id }}">{{ $systemIt->name }}</option>
                                @endforeach
                            </select>
                            @error('system_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="resources" class="form-label">Zasoby</label>
                            <select id="resources" class="form-control js-example-basic-multiple" name="resource_ids[]" multiple="multiple">
                                @foreach($resources as $resource)
                                    <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                                @endforeach
                            </select>
                            @error('resource_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="law_basics" class="form-label">Podstawy prawne</label>
                            <select id="law_basics" class="form-control js-example-basic-multiple" name="law_basic_ids[]" multiple="multiple">
                                @foreach($basicLaw as $bl)
                                    <option value="{{ $bl->id }}">{{ $bl->name }}</option>
                                @endforeach
                            </select>
                            @error('law_basic_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 col-12">
                            <label for="processing" class="form-label">Przetwarzanie</label>
                            <select class="form-control" id="processing" name="processing">
                                @foreach(\App\Models\DataSets\Dataset::$processing as $key => $processing)
                                    <option value="{{ $key }}">{{ $processing }}</option>
                                @endforeach
                            </select>
                            @error('processing')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="data_retention" class="form-label">Retencja danych</label>
                            <input type="text" class="form-control" id="data_retention" name="data_retention_set">
                            @error('data_retention_set')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="data_source" class="form-label">Źródło danych</label>
                            <input type="text" class="form-control" id="data_source" name="data_source">
                            @error('data_source')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="estimated_data" class="form-label">Szacowana ilość danych</label>
                            <input type="text" class="form-control" id="estimated_data" name="estimated_data">
                            @error('estimated_data')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 col-12">
                            <label for="purpose_processing" class="form-label">Cel przetwarzania</label>
                            <textarea id="purpose_processing" name="purpose_processing" rows="3"
                                      class="form-control"></textarea>
                            @error('purpose_processing')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="attachments" class="form-label">Załączniki</label>
                            <input id="attachments" class="form-control" type="file" multiple="multiple"
                                   name="attachments">
                            @error('attachments')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Zapisz</button>
                            <a href="{{ route('inspector.datasets.index') }}" class="btn btn-outline-danger btn-sm">Anuluj</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
