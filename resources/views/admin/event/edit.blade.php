@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="page-wrapper" style="margin-top:3rem;">
    <div class="page-content">
        <div class="card p-2">
            <div class="card-body">
                <h3 class="h2 mb-4">Edit Event/Announcement</h3>
                <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Event Name<font color="red">*</font></label>
                            <input type="text" name="event_name" class="form-control" placeholder="Enter Event Name" value="{{ old('event_name', $event->event_name) }}" required>
                            @error('event_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Convener Name<font color="red">*</font></label>
                            <input type="text" name="convenor" class="form-control" placeholder="Enter Name" value="{{ old('convenor', $event->convenor) }}" required>
                            @error('convenor')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Convener Mob No.<font color="red">*</font></label>
                            <input type="text" name="mob" class="form-control" placeholder="Enter Mobile Number" value="{{ old('mob', $event->mob) }}" required>
                            @error('mob')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Place/Hall<font color="red">*</font></label>
                            <input type="text" name="place" class="form-control" placeholder="Enter Event Place" value="{{ old('place', $event->place) }}" required>
                            @error('place')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Date<font color="red">*</font></label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', $event->date) }}" required>
                            @error('date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Time<font color="red">*</font></label>
                            <input type="time" name="time" class="form-control" value="{{ old('time', $event->time) }}" required>
                            @error('time')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Event Intro Attachment</label>
                            <input type="file" name="intro_event" class="form-control">
                            @if($event->intro_event)
                                <p>Current File: <a href="{{ asset($event->intro_event) }}" target="_blank">View File</a></p>
                            @endif
                            @error('intro_event')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('admin.event.index') }}" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
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
