@extends('templates.layout')


@section('content')
<div class="container py-5">



  <div class="row">
    <div class="col-lg-7 mx-auto">
      <div class="bg-white rounded-lg shadow-sm p-5">
       
        <!-- Credit card form content -->
        <div class="tab-content">

          <!-- credit card info-->
          <div id="nav-tab-card" class="tab-pane fade show active">
            <form role="form" action="/profile/update/{{Auth::id()}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="form-group">
                <label for="Fname">Full name</label>
                <input type="text" name="fullname" placeholder="John Collins" required class="form-control" value="{{$profile->fullname}}">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" placeholder="+62*********" required class="form-control" value="{{$profile->phone}}">
              </div>

              <div class="form-group">
                 <select class="custom-select" id="inputGroupSelect01" name="gender">
                  <option disabled {{ is_null($profile->gender) ? "selected" : "" }}>Gender...</option>
                  <option value="pria" {{ ($profile->gender == "pria") ? "selected" : "" }}>Pria</option>
                  <option value="wanita" {{ ($profile->gender == "wanita") ? "selected" : "" }}>Wanita</option>
                  <option value="other" {{ ($profile->gender == "other") ? "selected" : ""}}>Others</option>
                </select>
              </div>
              
               <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" placeholder="Address" id="address" style="height: 100px" name="address">{{$profile->address}}</textarea>
              </div>

            
              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="img" id="img">
                  <label class="custom-file-label" for="inputGroupFile01">Profile Picture</label>
                </div>

                 @error('img')
                  <div class="alert alert-danger">
                      {{ $message }}
                  </div>
                @enderror
              </div>
              
              
              <button type="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" > Confirm  </button>
            </form>
          </div>
          <!-- End -->

         
        </div>
        

      </div>
    </div>
  </div>
</div>

@endsection