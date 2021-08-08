@extends('templates.layout')


@section('search')
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/search" method="post">
        @csrf
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2" name="username">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
            </div>
    </form>    
@endsection


@section('content')
    
    <div class="row">
        @foreach ($users as $user)
        <div class="col-lg-6">
            <!-- Default Card Example -->
                <a href="/search-view/{{$user->id}}">
                 <div class="card shadow mb-4">
                     <div class="card-header py-3">
                         <h6 class="m-0 font-weight-bold text-primary">{{$user->username}}</h6>
                     </div>
                     <div class="card-body">
                         <h3 class="card-title">{{$user->email}}</h3>                                                                  
                     </div>
                 </div>
             </a>
         </div>  
        @endforeach
    </div>

@endsection