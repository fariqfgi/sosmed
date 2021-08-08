<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Followable;

class Profile extends Model
{
    use Followable;
    protected $table = "profile";

    protected $fillable = ['user_id'];

}
