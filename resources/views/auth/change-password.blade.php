@extends('templates.layout')


@section('content')
<div class="container py-5">



  <div class="row">
  
    <div class="col-lg-7 mx-auto">
      <div class="bg-white rounded-lg shadow-sm p-5">
       

        <!-- Credit card form content -->
        <div class="tab-content">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
          <!-- credit card info-->
          <div id="nav-tab-card" class="tab-pane fade show active">
            <form role="form" action="/change-password/{{Auth::id()}}" method="POST">
              @csrf
        
              <div class="form-group">
                <label for="tulisan">Password</label>
                <input type="password"  placeholder="Password" required class="form-control"  name="password">
              </div>
              <div class="form-group">
                <label for="caption">Confirm Your Password</label>
                <input type="password"  placeholder="Confirm Your Password!" required class="form-control"  name="password2">
              </div>

              <button type="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Change Password </button>
            </form>
          </div>
          <!-- End -->

         
        </div>
        

      </div>
    </div>
  </div>
</div>

@endsection