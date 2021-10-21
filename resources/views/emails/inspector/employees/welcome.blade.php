@extends('layouts.email', ['header' => 'Nowa zadanie do wykonania'])
@section('content')
    <p>
        Konto pracownika właśnie zostało utworzone. <br/>
        Poniżej znajdziesz dane do logowania.
    </p>
    <div style="">
        Email: {{ $data['user']->email }} <br/>
        Hasło: {{ $data['generatePassword'] }}
    </div>
    <small>Hasło zostało wygenerowane automatycznie. Pamiętaj aby zmienić je zaraz po pierwszym logowaniu</small>
@endsection
