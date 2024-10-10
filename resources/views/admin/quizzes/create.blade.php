@extends('layouts.admin')

@section('title', 'Quiz')

@section('content')
    <div class="container">
        <div class="card p-4">
            <h1 class="h2 mb-4">Create Quiz</h1>
            <form action="{{ route('admin.quizzes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="test_name" class="form-label">Test Name</label>
                        <input type="text" class="form-control" id="test_name" name="test_name" required>
                    </div>

                    <div class="col-md-3">
                        <label for="test_date" class="form-label">Test Date</label>
                        <input type="date" class="form-control" id="test_date" name="test_date" required>
                    </div>

                    <div class="col-md-3">
                        <label for="start_time" class="form-label">Test Start Time<font color="red"><b>*</b></font>
                        </label>
                        <input type="time" class="form-control" id="start_time" name="start_time" required>
                    </div>

                    <div class="col-md-3">
                        <label for="end_time" class="form-label">Test End Time<font color="red"><b>*</b></font></label>
                        <input type="time" class="form-control" id="end_time" name="end_time" required>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">Status<font color="red"><b>*</b></font></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create your questions</button>
                    </div>
                </div>

            </form>
        </div>


    </div>
@endsection
