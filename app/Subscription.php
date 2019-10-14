<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
         protected $table = 'subscription_gym';

    	 protected $guarded = [];
    	 public $timestamps = false;
}
