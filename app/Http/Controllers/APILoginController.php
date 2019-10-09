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
            if (! $token = JWTAuth::attempt( $credentials) ) {
                # code...
                return response()->json( ['error'=> 'invalid username and password'],401);
            }
        }catch(JWTException $e){
          return response()->json( ['error'=> 'could not create token'],500);
        }


       /* $data = \DB::table('model_has_roles')
      ->select('users.name', 'roles.name')
      ->join('users', 'users.id', '=', 'model_has_roles.model_id')
      ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
      ->where('users.id', auth()->user()->id)
      ->get();*/


        //return response()->json( [compact('token'), 'user' =>  auth()->user() ]);

      
        //return  $data;
      $user = User::find(auth()->user()->id);

        /*dd($user->roles);
       $users = User::select([])->with('roles');*/


      
       return response()->json(

        [compact('token'), 'user' =>  auth()->user() , $user->roles->pluck('name') ]);
        
    }

}
