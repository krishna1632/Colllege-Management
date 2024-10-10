@extends('layouts.partials')

@section('content')
    <div class="container">
        <h1>Edit Quiz</h1>
        <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="test_name" class="form-label">Test Name</label>
                <input type="text" class="form-control" id="test_name" name="test_name" value="{{ $quiz->test_name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="test_date" class="form-label">Test Date</label>
                <input type="date" class="form-control" id="test_date" name="test_date" value="{{ $quiz->test_date }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="test_duration" class="form-label">Test Duration (in minutes)</label>
                <input type="number" class="form-control" id="test_duration" name="test_duration"
                    value="{{ $quiz->test_duration }}" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="active" {{ $quiz->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $quiz->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Quiz</button>
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
