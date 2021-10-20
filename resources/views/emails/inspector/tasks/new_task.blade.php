@extends('layouts.email')
@section('content')
    <p>Witaj, {{ $data['task']->user?->name }}. Właśnie przydzielono Ci zadanie <b> {{ $data['task']->name }}</b> które należy wykonać do {{ $data['task']->deadline }}</p>
@endsection
