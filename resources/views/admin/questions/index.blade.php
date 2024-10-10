@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Question List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>Question</th>
                    <th>Options</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $question->question_text }}</td>
                        <td>{{ implode(', ', json_decode($question->options)) }}</td>
                        <td>
                            <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Final Submit Button -->


        <div class="d-flex justify-content-between mt-4">
            <form action="{{ route('admin.questions.create', $quiz) }}" method="GET">
                <button type="submit" class="btn btn-info">Add Questions</button>
            </form>
            <form action="{{ route('admin.quizzes.finalSubmit', $quiz_id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Final Submit</button>
            </form>
        </div>


    </div>
@endsection
