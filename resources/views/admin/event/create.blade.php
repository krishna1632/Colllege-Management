@extends('layouts.admin')

@section('title', 'Event Management')

@section('content')
        <!--start page wrapper -->
        <div class="page-wrapper "style="margin-top:3rem;">
            <div class="page-content">
                <!--breadcrumb-->
               
                <div class="card p-2">
                <div class="card-body">
                                <h3 class="h2 mb-4">Events/Annoucement</h3>
                        <form action="{{ route('event.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="single-select-clear-field" class="form-label">Event Name<font color="red"><b>*</b></font></label>
                                <input type="text" name="event_name" class="form-control"  placeholder="Enter Event Name" required>
                                  
                            </div>

                                <div class="col-md-3">
                                    <label class="form-label">Convener Name<font color="red"><b>*</b></font></label>
                                    <input type="text" name="convenor" class="form-control"  placeholder="Enter Name" required>
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Convener Mob No.<font color="red"><b>*</b></font></label>
                                    <input type="number" name="mob" class="form-control"  placeholder="Enter Mobile Number" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Place/Hall<font color="red"><b>*</b></font></label>
                                    <input type="text" name="place" class="form-control"  placeholder="Enter Event place" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Date<font color="red"><b>*</b></font></label>
                                    <input type="date" name="date" class="form-control"   required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Timeing<font color="red"><b>*</b></font></label>
                                    <input type="time" name="time" class="form-control"  placeholder="Enter Event place" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Event Intro Attachment<font color="red"><b>*</b></font></label>
                                    <input type="file" name="intro_event" class="form-control"  placeholder="Ente" required>
                                </div>
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ url('/admin/event/') }}" class="btn btn-light px-4">Cancle</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>        
                            </form>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection