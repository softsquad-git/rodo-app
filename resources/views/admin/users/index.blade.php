@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <div class="block-title"></div>
                <div class="block-options">
                    <button type="button" title="Szukaj" class="btn-block-option float-right w-auto">
                        <i class="si si-magnifier"></i>
                    </button>
                    <a href="{{ route('admin.users.create') }}" title="Dodaj" class="btn-block-option float-right w-auto">
                        <i class="si si-plus"></i>
                    </a>
                </div>
            </div>
            @if(count($data) > 0)
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('admin.users.items.email') }}</th>
                                <th scope="col">{{ __('admin.users.items.name') }}</th>
                                <th scope="col">{{ __('admin.users.items.role') }}</th>

                                <th scope="col">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ __('trans.roles.'.$item->role) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.users.update', ['id' => $item->id]) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit Client">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.users.remove', ['id' => $item->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn remove-form btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove Client">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                @include('partials.no_data')
            @endif
        </div>
    </div>
@endsection
