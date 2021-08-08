<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    protected $table = "postingan";
    protected $fillable = ["tulisan", "caption", "quote", "user_id", "gambar"];

    public function  user_id (){
        $this->hasMany("App\Postingan");
    }

    function user(){
        return $this->belongsToMany('App\User', 'komentar');
    }


    public function users ()
    {
        return $this->belongsTo('App\User','user_id');
    }


}
