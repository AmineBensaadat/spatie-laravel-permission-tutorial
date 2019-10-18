<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gym;
use App\User; 
use App\Payment_history; 
use DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Response;
use Validator;
use JWTAuth;

class APIPayment_historyController extends Controller
{
    // get payment history of member
     public function getAllPayment_historyBymember($id_member){

		      $result = Payment_history::select('*')
		     ->where('id_member', '=', $id_member)
		      ->get();
		       return Response::json($result);
		    }
}
