<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Postingan;
use App\Komentar;
use App\KomentarLike;
use App\PostinganLikes;
use Alert;

class PostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($id)
    {   
        if($id == Auth::id()){
            $post = Postingan::where('user_id', $id)->orderBy('id', 'desc')->get();
        
            return view('app.my-post', compact('post'));
        }else{
             Alert::success('Gagal', 'Anda Tidak Mempunyai Hak akses!');
            return redirect('profile/' . Auth::id());
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   


       
        $this->validate($request, [
            'tulisan' => 'required',
            'caption'    => 'required',
            'quote'    => 'required',
        ]);

        $id = Auth::id();

        if(is_null($request->photo)){
            Postingan::create([
                'tulisan' => $request->tulisan,
                'caption' => $request->caption,
                'quote' => $request->quote,
                'user_id' => $id
            ]);

        }else{

            $this->validate($request, [
                'photo' => 'mimes:png,jpg,jpeg|max:1024'
            ]);
            
            $post_picture = $request->photo;
            $picture_name = time() . "-" . $post_picture->getClientOriginalName();

            
            Postingan::create([
                'tulisan' => $request->tulisan,
                'caption' => $request->caption,
                'quote' => $request->quote,
                'gambar' => $picture_name,
                'user_id' => $id
            ]);

            $post_picture->move('uploads/post/', $picture_name);
        }
       

      
        Alert::success('Sukses', 'Sukses Posting');
        return redirect('/my-post/' . Auth::id());
        
    }

    public function liked ($id, $postid)
    {           

         $komentarlike = KomentarLike::where('user_id', Auth::id())->get();

         foreach($komentarlike as $komentar){
             if($komentar->komentar_id == $id){
                Alert::success('Berhasil', 'Anda Sudah Unlike');
                KomentarLike::destroy($komentar->id);
                return redirect('/post/' . $postid);
             }
         }
       
        $komentarlike = new KomentarLike;

        $komentarlike->user_id = Auth::id();

        $komentarlike->komentar_id = $id;

        $komentarlike->save();

        Alert::success('Sukses', 'Sukses Like Komentar');
        return redirect('/post/' . $postid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Postingan::find($id);
        $komentar = Komentar::where('postingan_id', $id)->get();
        $countKomentar = count($komentar);

        $komentarLike = KomentarLike::all();

        // $komentarLiked = KomentarLike::all();

        return view('app.comment-section', compact('post', 'komentar', 'countKomentar','komentarLike'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Postingan::find($id);

        if (Auth::id() === $post->user_id) {
            return view('app.edit-post', compact('post'));
        } else {
            Alert::error('Gagal', 'Anda Tidak Mempunyai Hak akses!');
            return redirect()->back();
        }
        
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

        $this->validate($request, [
            'tulisan' => 'required',
            'caption'    => 'required',
            'quote'    => 'required',
        ]);

        if(is_null($request->photo)){

            $post = Postingan::find($id);
            $post->tulisan = $request->tulisan;
            $post->caption = $request->caption;
            $post->quote = $request->quote;
            $post->update();

        }else{
            $this->validate($request, [
                'photo' => 'mimes:png,jpg,jpeg|max:1024'
            ]);
            

             $post_picture = $request->photo;
             $picture_name = time() . "-" . $post_picture->getClientOriginalName();

            $post = Postingan::find($id);
            $post->tulisan = $request->tulisan;
            $post->caption = $request->caption;
            $post->quote = $request->quote;
            $post->gambar = $picture_name;
            $post->update();

            $post_picture->move('uploads/post/', $picture_name);
             
        }
        Alert::success('Sukses', 'Sukses Ubah Postingan');
        return redirect('/my-post/'. Auth::id());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Postingan::find($id);
        if (Auth::id() === $post->user_id) {
            
            $komentar = Komentar::where('postingan_id', $id)->get();
            foreach ($komentar as $value) {
                KomentarLike::where('komentar_id', $value->id)->delete();
            }
            Komentar::where('postingan_id', $id)->delete();
            PostinganLikes::where('postingan_id' , $id)->delete();

            $post->delete();
            Alert::success('Sukses', 'Sukses Hapus Postingan');
        } else {
            Alert::error('Gagal', 'Anda Tidak Mempunyai Hak akses!');
        }

        return redirect()->back();
    }
}
