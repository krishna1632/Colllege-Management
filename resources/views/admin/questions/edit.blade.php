@extends('layouts.partials')

@section('content')
    <div class="container">
        <h1>Edit Question</h1>
        <form action="{{ route('questions.update', $question->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="question_text" class="form-label">Question</label>
                <input type="text" class="form-control" id="question_text" name="question_text"
                    value="{{ $question->question_text }}" required>
            </div>
            <div class="mb-3">
                <label for="options" class="form-label">Options</label>
                @foreach (json_decode($question->options) as $index => $option)
                    <input type="text" class="form-control" name="options[]" value="{{ $option }}"
                        placeholder="Option {{ $index + 1 }}">
                @endforeach
            </div>
            <div class="mb-3">
                <label for="correct_option" class="form-label">Correct Option</label>
                <input type="text" class="form-control" id="correct_option" name="correct_option"
                    value="{{ $question->correct_option }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Question</button>
            <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
