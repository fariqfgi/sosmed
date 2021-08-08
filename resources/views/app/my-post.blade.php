@extends('templates.layout')


@section('content')
    
<div class="row">
    @forelse ($post as $value )
   
       <div class="col-lg-6">
           <!-- Default Card Example -->
            {{-- <a href="/asas" > --}}
                <div class="card shadow mb-4" >
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ ucfirst(Auth::user()->username) }}</h6>
                    </div>
                    <div class="card-body">
                        @if ($value->gambar !== NULL )
                            <div class="row">
                                <div class="col-6 mx-auto">
                                    <img src="/uploads/post/{{$value->gambar}}" class="card-img-top" alt="gambar" style="width: 100%;">
                                </div>
                            </div>
                        @endif
                        
                        <h3 class="card-title">{{ $value->caption }}</h3>
                        <p class="card-text">{{ $value->quote }}</p>
                        {{-- tulisan --}}
                        <p class="card-text"> <p class="card-text">{{ $value->tulisan }}</p></p>
                        
                        <a href="/likes/{{$value->id}}"><i  class="fa fa-thumbs-up mx-3"></i></a>
                        <a href="/post/{{ $value->id }}"><i  class="fa fa-comment"></i></a>
                        <form action="/post/{{$value->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-sm btn-danger mx-2 float-right" value="Delete">
                        </form>
                        <a href="/post/{{ $value->id }}/edit" class="btn btn-sm btn-primary mx-2 float-right">Edit</a>                                           
                       
                    </div>
                </div>
            </a>
        </div>  
    @empty
        
    @endforelse
    </div>

   
@endsection