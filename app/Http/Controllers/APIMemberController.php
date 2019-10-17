<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gym;
use App\User; 
use App\Members; 
use DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Response;
use Validator;
use JWTAuth;


class APIMemberController extends Controller
{
	   public function createMember(Request $request)
	    {
	        /*
	             $validator = Validator::make($request -> all(),[
	            'email' => 'required|string|email|max:255|unique:users',
	            'firstname' => 'required',
	            'lastname' => 'required'
	        ]);

	        if ($validator -> fails()) {
	            return response()->json($validator->errors());
	        }*/

	       $member_created = Members::create([

	            'id_Gym' => $request->get('id_Gym'),
	            'firstname' => $request->get('firstname'),
	            'lastname' => $request->get('lastname'),
	            'cin' => $request->get('cin'),
	            'email' => $request->get('email'),
	            'city' => $request->get('city'),
	            'adresse' => $request->get('adresse'),
	            'phone' => $request->get('phone'),
	            'image' => $request->get('image'),
	            'description' => $request->get('description'),
	            'statut' => 'payed',
	            'last_paiement_date' => 'in dev',
	            'last_expire_date' => 'in dev',
	            'on_pause_days' => 'in dev',
	            'left_to_pay' => ' in dev',
	            'id_Subscription' => $request->get('description')
	        ]);

	     
	        return Response::json($member_created);
	    }

}
