<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_history extends Model
{
     	 protected $table = 'payment_history';

    	 protected $guarded = [];
    	 public $timestamps = false;
}
