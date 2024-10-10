@extends('layouts.user')


@section('content')
    <h1 class="mt-4 " style="font-size:25px">Welcome,
    <span class="navbar-text me-3 mt-7 text-primary " style="font-size:35px">
                {{ Auth::user()->name }}
            </span>
    </h1>
                        <ol class="breadcrumb mb-4">
                            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
                        </ol>
                        <div class="row">
                            <div class="container col-md-4">
                              <div class="card">
                                  <div class="card-header">
                                      View Profile
                                  </div>
                                  <div class="card-body">
                                      <form>
                                          <div class="mb-3">
                                              <label for="name" class="form-label">Full Name</label>
                                              <input type="text" class="form-control" id="fullName" value="{{ $user->name }}" readonly>
                                          </div>
                                          
                                          <div class="mb-3">
                                              <label for="email" class="form-label">Email</label>
                                              <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                                          </div>
                                          
                                          <div class="mb-3">
                                              <label for="phone" class="form-label">Phone</label>
                                              <input type="text" class="form-control" id="phone" value="{{ $user->phone }}" readonly>
                                          </div>
                                          
                                          <div class="mb-3">
                                              <label for="profilePic" class="form-label">Profile Picture</label>
                                              <input type="file" class="form-control" id="profilePic" >
                                          </div>
                                          
                                          
                                          
                                          <!-- Buttons hidden for view-only mode -->
                                          <button type="button" class="btn btn-primary button">Update Profile</button>
                                          <button type="button" class="btn btn-secondary button">Change Password</button>
                                      </form>
                                  </div>
                              </div>
                            </div>
                        </div>
@endsection