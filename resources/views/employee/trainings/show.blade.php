@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <table class="table">
                    <thead>
                    <tr>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Numer</td>
                        <td>
                            {{ $training->number }}
                        </td>
                    </tr>
                    <tr>
                        <td>Nazwa</td>
                        <td>{{ $training->name }}</td>
                    </tr>
                    <tr>
                        <td>Opis</td>
                        <td>{!! $training->description !!}</td>
                    </tr>
                    </tbody>
                </table>

                <a href="{{ route('employee.trainings.browser', ['id' => $training->id]) }}" class="btn btn-outline-primary btn-sm">Rozpocznij szkolenie</a>
            </div>
        </div>
    </div>
@endsection
