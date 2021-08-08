<?php

namespace App\Http\Controllers;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class ProfileController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        if(Auth::id() == $id){

            $profile = Profile::where('user_id',$id)->first();

            // count follower
            $follower = $profile->followers()->count();
            // count following
            $following = $profile->followings()->count();

            
            return view('app.profile', compact('profile', 'follower', 'following'));
        }else{
            Alert::success('Gagal', 'Anda Tidak Mempunyai Hak akses!');
            return redirect('profile/' . Auth::id());
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        
       
        if($id == Auth::id()){
             return view('app.profile-settings', [
            "profile" => Profile::where("user_id", Auth::id())->first()
            ]);
        }else{
             Alert::success('Gagal', 'Anda Tidak Mempunyai Hak akses!');
             return redirect('settings/' . Auth::id());
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

        if($id == Auth::id()) {

            $profile = Profile::find($id);

            if (is_null($request->img)) {
      
                $profile->fullname = $request->fullname;
                $profile->phone = $request->phone;
                $profile->gender = $request->gender;
                $profile->address = $request->address;

                $profile->save();

            } else {

                $this->validate($request, [
                    'img' => 'mimes:png,jpg,jpeg|max:1024'
                ]);

                $profile_picture = $request->img;
                $picture_name = time() . "-" . $profile_picture->getClientOriginalName();

                $profile->fullname = $request->fullname;
                $profile->phone = $request->phone;
                $profile->gender = $request->gender;
                $profile->address = $request->address;
                $profile->profile_picture = $picture_name;

                $profile->save();

                $profile_picture->move('uploads/profile/', $picture_name);

            }

            Alert::success('Sukses', 'Sukses Update Profile!');
            
            return redirect('profile/' . Auth::id());
        }else{
            Alert::error('Gagal', 'Anda Tidak Mempunyai Hak akses!');
            return redirect('settings/' . Auth::id());
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
}
