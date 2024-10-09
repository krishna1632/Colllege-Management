@extends('layouts.admin')

@section('title', 'Event Management')

@section('content')
    <h1 class="mt-4">Events/Announcement Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Events</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Events/Announcement List
            <a href="{{ url('/admin/event/create') }}" class="btn btn-primary btn-sm float-end">Create Event</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event Name</th>
                        <th>Convener</th>
                        <th>Convener Mob.</th>
                        <th>Place</th>
                        <th>Date</th>
                        <th>Event Start Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->event_name }}</td>
                            <td>{{ $event->convenor }}</td>
                            <td>{{ $event->mob }}</td>
                            <td>{{ $event->place }}</td>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->time }}</td>
                            <td>
                                <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
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
    @if(session('success'))
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,  // Hide the OK button
                    timer: 3000,                // Popup will disappear after 4 seconds
                    timerProgressBar: true,     // Optional: Show progress bar
                });
            }
        </script>
    @endif
@endsection
