@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Inspektor']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="post"
                      action="{{ $item->id ? route('inspector.newsletter.update', ['id' => $item->id]) : route('inspector.newsletter.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label for="title" class="form-label">{{ __('inspector.newsletter.form.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{{ $item->title ? $item->title : old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="from" class="form-label">{{ __('inspector.newsletter.form.from') }}</label>
                            <input type="datetime-local" class="form-control" name="from" value="{{ $item->from ? $item->from : old('from') }}">
                            @error('from')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="to" class="form-label">{{ __('inspector.newsletter.form.to') }}</label>
                            <input type="datetime-local" class="form-control" name="to" value="{{ $item->to ? $item->to : old('to') }}">
                            @error('to')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 col-12">
                            <label for="content" class="form-label">{{ __('inspector.newsletter.form.content') }}</label>
                            <textarea id="content" class="editor" name="content">{{ $item->content ? $item->content : old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 col-12">
                            <label for="status" class="form-label">{{ __('inspector.newsletter.form.status') }}</label>
                            <select class="form-control" name="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="clients" class="form-label">{{ __('inspector.newsletter.form.clients') }}</label>
                            <select class="form-control form-control-sm js-example-basic-multiple" multiple="multiple" name="client_ids[]">
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <label for="is_all_clients" class="w-100"><input type="checkbox" id="is_all_clients" value="1" name="is_all_clients"> Przypisz do wszystkich</label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" type="submit">{{ __('trans.save') }}</button>
                        <a href="{{ route('inspector.newsletter.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
