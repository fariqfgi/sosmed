<?php

namespace App\Http\Controllers;
use App\PostinganLikes;
use App\Postingan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostinganLikesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        if($id == Auth::id()){
            $post = \DB::table('postingan')
            ->join('postingan_likes', 'postingan.id' , 'postingan_likes.postingan_id')
            ->join('users', 'postingan.user_id', 'users.id')
            ->select("postingan.*", "postingan_likes.user_id", "users.username")->orderBy('id', 'desc')->get();
            
            return view("app.liked-post",[
                'post' => $post
            ]);
            
        }else{
             Alert::success('Gagal', 'Anda Tidak Punya Hak akses!');
            return redirect('/liked-post/' . Auth::id());
         }
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {       
            $postingan =  PostinganLikes::where('postingan_id' , $id)->get();
            
            foreach($postingan as $post){
                    if($post->user_id === Auth::id()){
                        PostinganLikes::destroy($post->id);
                        Alert::success('Berhasil', 'Anda Sudah Unlike!');
                        return redirect('liked-post/' . Auth::id());
                    }
            }
            
            $postingan_likes = new PostinganLikes;

            $postingan_likes->user_id = Auth::id();
            $postingan_likes->postingan_id = $id;

            $postingan_likes->save();
            
            Alert::success('Sukses', 'Sukses Like Postingan');
            return redirect('liked-post/' . Auth::id());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {       
        
           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
