<?php

namespace App\Http\Controllers;
use App\Postingan;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Profile::where('user_id' , Auth::id())->first() === NULL ){
            Profile::create(['user_id' => Auth::id()]);
        };
       
    

    //    $posts = \DB::table("postingan")->join('users', 'users.id' , '=', 'postingan.user_id')
    //    ->select('postingan.id', 'postingan.tulisan', 'postingan.quote', 'postingan.caption', 'users.username')->get();

    //     $posts = \DB::table("postingan")->join('users', 'users.id' , '=', 'postingan.user_id')
    //    ->select('postingan.id', 'postingan.tulisan', 'postingan.quote', 'postingan.caption', 'users.username')->orderBy('id', 'desc')->limit(6)->get();


        $posts = Postingan::orderBy('id', 'desc')->limit(6)->get();

       return view('app.index', [
           'posts' => $posts
       ]);


    }

    
}
