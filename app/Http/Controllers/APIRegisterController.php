<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Response;
use Validator;
use JWTAuth;

class APIRegisterController extends Controller
{
    public function register( Request $request){
    	$validator = Validator::make($request -> all(),[
    		'email' => 'required|string|email|max:255|unique:users',
    		'name' => 'required',
    		'password' => 'required'
    	]);

    	if ($validator -> fails()) {
    		return response()->json($validator->errors());
    	}

    	User::create([

    		'name' => $request->get('name'),
    		'email' => $request->get('email'),
    		'password' => bcrypt($request->get('password')),
    	]);

    	$user = User::first();
    	$token = JWTAuth::fromUser($user);
    	return Response::json(compact('token'));
    }
}
