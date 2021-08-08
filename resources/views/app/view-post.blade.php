@extends('templates.layout')

@section('search')
    <a href="/search-view/{{$user->id}}" class="btn btn-primary ml-2 mr-2"><i class="fas fa-backspace"></i></i></a>     
    

@endsection

@section('content')
    <h3 class="ml-2 mr-2">{{$user->username}} Post</h3>
<div class="row">
     
    @forelse ($post as $value )
   
       <div class="col-lg-3">
           <!-- Default Card Example -->
            {{-- <a href="/asas" > --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $user->username }}</h6>
                    </div>
                    <div class="card-body" style="width: 18rem;">
                        @if ($value->gambar !== NULL )
                            <img src="/uploads/post/{{$value->gambar}}" class="card-img-top" alt="..." style="width: 100%;">
                        @endif
                        
                        <h3 class="card-title">{{ $value->caption }}</h3>
                        <p class="card-text">{{ $value->quote }}</p>
                        {{-- tulisan --}}
                        <p class="card-text"> <p class="card-text">{{ $value->tulisan }}</p></p>
                        
                        <a href="/likes/{{$value->id}}"><i  class="fa fa-thumbs-up mx-3"></i></a>
                        <a href="/post/{{ $value->id }}"><i  class="fa fa-comment"></i></a>     
                    </div>
                </div>
            </a>
        </div>  
    @empty
        
    @endforelse
    </div>

   
@endsection