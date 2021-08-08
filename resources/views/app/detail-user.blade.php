@extends('templates.layout')


@section('content')
    <div class="container">
    <div class="main-body">
    
         
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ is_null($profile->profile_picture) ? "https://bootdey.com/img/Content/avatar/avatar7.png" : asset('/uploads/profile/' . $profile->profile_picture) }}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{$user->username}}</h4>
                      
                    </div>
                  </div>
                    <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                    <div class="d-flex flex-column"> <span class="articles">Following</span> <span class="number1">{{ $following }}</span> </div>
                    <div class="d-flex flex-column"> <span class="followers">Followers</span> <span class="number2">{{ $follower }}</span> </div>
                  </div>
                  <div class="text-center mt-2">
                    <form action="/follow" method="POST" class="d-inline">
                    @csrf
                      <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                      <button type="submit" class="btn btn-primary">{{ $button }}</button>
                    </form>
                      <a href="/view-post/{{$user->id}}" class="btn btn-info">View All Post</a>
                    
                  </div>
                </div>
              </div>
         
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$profile->fullname}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     {{$user->email}} 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     {{$profile->gender}} 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$profile->phone}}
                    </div>
                  </div>
                  <hr>
                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$profile->address}}
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
              
              


            </div>
          </div>

        </div>
    </div>
@endsection