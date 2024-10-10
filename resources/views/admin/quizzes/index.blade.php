@extends('layouts.admin')

@section('title', 'Quiz Management')

@section('content')
    <h1 class="mt-4">Quiz Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Quizzes</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Quiz List
            <a href="{{ route('admin.quizzes.create') }}" class="btn btn-primary btn-sm float-end">Conduct New Test</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Test Name</th>
                        <th>Test Date</th>
                        <th>Test Duration</th> <!-- Update this to show start and end time -->
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $quiz->test_name }}</td>
                            <td>{{ $quiz->test_date }}</td>
                            <td>{{ $quiz->start_time }} - {{ $quiz->end_time }}</td> <!-- Updated to show start and end time -->
                            <td>{{ $quiz->status }}</td>
                            <td>
                                <a href="{{ route('admin.quizzes.edit', $quiz->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert Success Popup -->
    @if (session('success'))
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false, // Hide the OK button
                    timer: 3000, // Popup will disappear after 4 seconds
                    timerProgressBar: true, // Optional: Show progress bar
                });
            }
        </script>
    @endif
@endsection
