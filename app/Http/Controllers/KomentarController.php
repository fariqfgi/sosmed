<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Komentar;
use App\KomentarLike;
use Alert;

class KomentarController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'komentar' => 'required',
            'postingan_id' => 'required'
        ]);

        $user_id = Auth::id();

        Komentar::create([
            'isi' => $request->komentar,
            'user_id' => $user_id,
            'postingan_id' => $request->postingan_id,
        ]);

        Alert::success('Sukses', 'Sukses komentar');
        return redirect('/post/' . $request->postingan_id);
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
        $komentar = Komentar::find($id);
        if ($komentar->user_id === Auth::id()) {
            return view('app.edit-komen', compact('komentar'));
        } else {
            Alert::error('Gagal', 'Anda tidak memiliki hak akses!');
        }

        return redirect()->back();
        
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
            'komentar' => 'required'
        ]);

        $komentar = Komentar::find($id);
        if ($komentar->user_id === Auth::id()) {
            $komentar->isi = $request->komentar;
            $komentar->update();
            Alert::success('Sukses', 'Sukses Edit komentar');
        } else {
            Alert::error('Gagal', 'Anda tidak memiliki hak akses!');
        }
        
        return redirect('/post/'. $komentar->postingan_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komentar = Komentar::find($id);
        if ($komentar->user_id === Auth::id()) {
            KomentarLike::where('komentar_id', $id)->delete();
            $komentar->delete();
            Alert::success('Sukses', 'Sukses Hapus komentar');
        } else {
            Alert::error('Gagal', 'Anda tidak memiliki hak akses!');
        }
        
        return redirect()->back();
    }
}
