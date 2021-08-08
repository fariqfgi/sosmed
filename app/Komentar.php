<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = "komentar";
    protected $fillable = ["isi", "user_id", "postingan_id"];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
