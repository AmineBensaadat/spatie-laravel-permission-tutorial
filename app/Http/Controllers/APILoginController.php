<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Response;
use Validator;
use JWTAuth;

class APILoginController extends Controller
{
  public function login( Request $request){
        $validator = Validator::make($request -> all(),[
         'email' => 'required|string|email|max:255',
         'password'=> 'required'
        ]);
        if ($validator -> fails()) {
            # code...
            return response()->json($validator->errors());
            
        }
       
        $credentials = $request->only('email','password');
        try{
                    if (! $token = JWTAuth::attempt($credentials) ) {
                # code...
                return response()->json( ['error'=> 'invalid username and password'],401);
            }
        }catch(JWTException $e){
          return response()->json( ['error'=> 'could not create token'],500);
        }
        
         //return response()->json( [compact('token'), 'user' =>  auth()->user()->with('roles')->get()->first() ]);
         //return response()->json([compact('token'), 'user' =>auth()->user(),auth()->user()->roles->pluck('')->filter()]) ;
         //return response()->json([auth()->user(),auth()->user()->roles->pluck('')->filter()]) ;
         
         return response()->json([compact('token'), 'user' =>auth()->user(),auth()->user()->roles->pluck('')->filter(), auth()->user()->getAllPermissions()->pluck('')->filter()]) ;
        
    }

}
