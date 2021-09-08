@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div class="content">
        @if($data->count() > 0)
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-title"></div>
                    <div class="block-options">
                        <button type="button" title="Pobierz plik" class="btn-block-option float-right w-auto">
                            <i class="si si-cloud-download"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('admin.logs.items.ip') }}</th>
                                <th scope="col">{{ __('admin.logs.items.user') }}</th>
                                <th scope="col">{{ __('admin.logs.items.action') }}</th>
                                <th scope="col">{{ __('admin.logs.items.resource') }}</th>
                                <th scope="col">{{ __('admin.logs.items.created_at') }}</th>
                                <th scope="col">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->ip_address }}</td>
                                    <td><a href="">{{ $item->user?->name }}</a></td>
                                    <td>{{ __('trans.actions.'.$item->action) }}</td>
                                    <td>---</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <form action="{{ route('admin.logs.remove', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="btn-group">
                                                <button type="button" class="btn remove-form btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Usuń">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            @include('partials.no_data')
        @endif
    </div>
@endsection
