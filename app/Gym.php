<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
     protected $table = 'gym';

     protected $fillable = [
        'name', 'id_user'
    ];
    
    public $timestamps = false;
}
