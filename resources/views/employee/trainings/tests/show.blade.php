@extends('layouts.employee')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['inspector.index' => 'Pracownik']])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <h3 style="margin-bottom: 10px">{{ $test->name }}</h3>

                {!! $test->description !!}

                <form method="POST" action="{{ route('employee.trainings.tests.complete', ['testId' => $test->id]) }}">
                    @csrf

                    @foreach($test->questions as $questionKey => $question)
                        <div class="question">{{ $question->name }}</div>
                        <div class="question-answers">
                            <div class="space-y-2">
                                @foreach($question->answers as $keyAnswer => $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="{{ $questionKey.$keyAnswer }}" name="answers[{{$question->id}}][]" value="{{ $answer->id }}">
                                        <label class="form-check-label" for="{{ $questionKey.$keyAnswer }}">{{ $answer->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <button class="btn btn-sm btn-primary mt-5" type="submit">Zakończ test</button>
                </form>

                <button id="showTest" class="btn btn-outline-success btn-sm">Rozpocznij test</button>
            </div>
        </div>
    </div>
@endsection
