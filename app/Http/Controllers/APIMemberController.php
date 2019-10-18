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

	    	//table insert in table membre
	        /*
	             $validator = Validator::make($request -> all(),[
	            'email' => 'required|string|email|max:255|unique:users',
	            'firstname' => 'required',
	            'lastname' => 'required'
	        ]);

	        if ($validator -> fails()) {
	            return response()->json($validator->errors());
	        }*/
	        $total_abnm = 30;
	       $member_created = Members::create([

	            'id_Gym' => $request->get('id_Gym'),
	            'firstname' => $request->get('firstname'),
	            'lastname' => $request->get('lastname'),
	            'cin' => $request->get('cin'),
	            'created_by' => $request->get('created_by'),
	            'email' => $request->get('email'),
	            'city' => $request->get('city'),
	            'adresse' => $request->get('adresse'),
	            'phone' => $request->get('phone'),
	            'image' => $request->get('image'),
	            'created_at' => date("Y-m-d"),
	            'description' => $request->get('description'),
	            'statut' => 'payed',
	            'last_paiement_date' => 'in dev',
	            'last_expire_date' => date('Y-m-d', strtotime(date("Y-m-d"). ' '.$total_abnm.' days')),
	            'on_pause_days' => 'in dev',
	            'left_to_pay' => ' in dev',
	            'id_Subscription' => $request->get('id_Subscription')
	        ]);


	       //insert in table payment history

	       $data_payment_hidtory = array(
	       	'id_member' => $member_created->id,
	       	'id_gym' => $member_created->id_Gym,
	       	'member_name' => $member_created->firstname." ".$member_created->lastname ,
	       	'created_by' => $member_created->created_by,
	       	'created_at' => date("Y-m-d"),
	       	'expired_at' => $member_created->last_expire_date,
	       	'id_Subscription' => $member_created->id_Subscription,
	       	'name_Subscription' => 'in dev',
	       	'amount_paid' => 00000,
	       	'paid_to_admin' => 0,
	       	'left_to_pay' => 'in dev',
	       	'comment' =>  $request->get('comment')
	       );
		    DB::table('payment_history')->insert($data_payment_hidtory);


	     
	        return Response::json($member_created);
	    }

	      public function getAllMembers(){

		      $result = Members::select('members.*', 'subscription_gym.name as subscription')
		      ->join('subscription_gym', 'subscription_gym.id', '=', 'members.id_Subscription')
		      ->get();
		       return Response::json($result);
		    }
}
