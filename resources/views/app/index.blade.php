@extends('templates.layout')


@section('content')
    
        <div class="row">

            @foreach ($posts as $post)
                 <div class="col-lg-6" >
            <!-- Default Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ ucfirst($post->users->username) }}</h6>
                    </div>
                    <div class="card-body">
                        @if ($post->gambar !== NULL )
                            <div class="row">
                                <div class="col-6 mx-auto">
                                    <img src="/uploads/post/{{$post->gambar}}" class="card-img-top" alt="image" style="width: 100%;">
                                </div>
                            </div>
                        @endif
                        <h3 class="card-title">{{$post->caption}}</h3>
                        <p class="card-text">{{$post->quote}}</p>
                        {{-- tulisan --}}
                        <p class="card-text"> <p class="card-text">{{$post->tulisan}}</p></p>
                        
                        <a href="/likes/{{$post->id}}"><i  class="fa fa-thumbs-up mx-3"></i></a>
                        <a href="/post/{{ $post->id }}"><i  class="fa fa-comment"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
           
            
         
        </div>

   
@endsection