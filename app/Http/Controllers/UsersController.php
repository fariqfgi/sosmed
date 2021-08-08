<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use App\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
    
    public function index()
    {   
        $allUsers = User::orderBy('id', 'DESC')->paginate(6);

        
        return view('app.search', ["users" => $allUsers]);
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('Auth.change-password');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $users = User::where('username', 'LIKE', "%$request->username%")->get();
       
        return view('app.searched', ["users" => $users]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // cek apakah sudah difollow?
        $user1 = User::find(Auth::id());
        $target1 = User::find($id);

        if ($user1->isFollowing($target1)) {
           $button = "Unfollow";
        } else {
            $button = "Follow";
        }

        // count follower
        $follower = $target1->followers()->count();
        // count following
        $following = $target1->followings()->count();

        $user = User::where('id', $id)->first();
        $profile = Profile::where('user_id', $id)->first();

        return view('app.detail-user', compact('user', 'profile', 'button', 'follower', 'following'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('app.view-post', [
            'post' => Postingan::where('user_id', $id)->get(),
            'user' => User::where('id', $id)->first()
        ]);
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
            if(Auth::id() == $id){
                $request->validate([
                    'password2' => ['required', 'string','min:8',],
                    'password' => ['required', 'string', 'min:8', ],
                ]);

                if($request->password !== $request->password2){
                    Alert::success('Gagal', 'Password Konfirmasi Tidak sama!');
                    return redirect('/change-password');
                }

                $users = User::find(Auth::id());

                $users->password = Hash::make($request->password);

                $users->save();


                Alert::success('Berhasil', 'Password anda telah kami ubah!');
                return redirect('/profile/' . Auth::id());
          }else{
               Alert::success('Gagal', 'Tidak Mempunyai Hak Akses!');
                return redirect('/change-password');
          }
            
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

    // follow request
    public function follow(Request $request)
    {
        if (Auth::id() == $request->user_id) {
            Alert::error('Gagal', 'Tidak bisa follow akun sendiri');
        } else {
            $user = User::find(Auth::id());
            $target = User::find($request->user_id);
            if ($user->isFollowing($target)) {
                $user->unfollow($target);
                Alert::success('Sukses', 'Sukses Unfollow');
            } else {
                $user->follow($target);
                Alert::success('Sukses', 'Sukses Follow');
            }
        }
        
        return redirect()->back();
    }
}
