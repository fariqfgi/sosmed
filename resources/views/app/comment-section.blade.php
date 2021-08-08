@extends('templates.layout')


@section('content')
    
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="d-flex flex-column col-md-8">
            <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
                
                <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1"></div>
                <div class="d-flex flex-column ml-3">
                    <h5 class="text-primary">{{ ucfirst($post->users->username) }}</h5>
                    @if ($post->gambar !== NULL )
                        <div class="row">
                            <div class="col-6 mx-auto">
                                <div class="d-flex flex-row post-title">
                                    <img src="/uploads/post/{{$post->gambar}}" class="card-img-top" alt="image" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="d-flex flex-row post-title">
                        <h5>{{ $post->caption }}</h5>
                    </div>
                     <div class="d-flex flex-row post-title">
                        <span class="ml-2">{{ $post->quote }}</span>
                    </div>
                    <div class="d-flex flex-row post-title">
                        <span class="ml-2">{{ $post->tulisan }}</span>
                    </div>
                    <div class="d-flex flex-row align-items-center align-content-center post-title">
                        <span class="mr-2 comments">{{$countKomentar}} comments&nbsp;</span><span class="mr-2 dot"></span>
                    </div>
                </div>
            </div>
            <div class="coment-bottom bg-white p-2 px-4">
                
                    <form action="/comment" method="post">
                        @csrf
                        <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                            <input type="text" name="komentar" class="form-control mr-3" placeholder="Add comment">
                            <input type="hidden" id="postingan_id" name="postingan_id" value="{{ $post->id }}">
                            <button class="btn btn-primary" type="submit">Comment</button>
                        </div>
                    </form>
                    
               
                    @php
                        $word = "";
                    @endphp
                    @foreach ($komentar as $value )
                        @foreach ($komentarLike as $komentar)
                            @if ($komentar->komentar_id == $value->id && $komentar->user_id == Auth::id())
                                @php
                                    $word = "Liked";
                                @endphp
                            @endif
                        @endforeach
            
                    <div class="commented-section mt-2">
                        <div class="d-flex flex-row align-items-center commented-user">
                            <h5 class="mr-2 text-primary">{{ ucfirst($value->user->username) }}</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">{{$word}}</span>
                        </div>
                        <div class="comment-text-sm"><span>{{ $value->isi }}</span></div>
                        <div class="reply-section">
                            <div class="d-flex flex-row align-items-center voting-icons">
                               
                                <a href="/like-comment/{{$value->id}}/{{$post->id}}"><i class="fa fa-thumbs-up  mt-1 hit-voting"></i></a>  
                                
                                <form action="/comment/{{$value->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-sm btn-danger mx-2 my-2" value="Delete">
                                </form>
                                <a href="/comment/{{ $value->id }}/edit" class="btn btn-sm btn-primary float-right mx-2 my-2">Edit</a>        
                                
                            </div>
                        </div>
                    </div>
                    @php
                        $word = "";
                    @endphp
                   
                @endforeach
                    
            </div>

            
        </div>
    </div>
</div>

@endsection