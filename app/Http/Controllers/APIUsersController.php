<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\Http\Controllers\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Response;
use Validator;
use JWTAuth;





class APIUsersController extends Controller
{
    public function getAllUsers(){

      $id = auth()->id();

	  $result = User::where('id', '!=', $id)->get();

    return $result;
    }
    
    public function createUser(Request $request)
    {
             $validator = Validator::make($request -> all(),[
            'email' => 'required|string|email|max:255|unique:users',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required'
        ]);

        if ($validator -> fails()) {
            return response()->json($validator->errors());
        }

        User::create([

            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $user = User::first();
        $token = JWTAuth::fromUser($user);
        return Response::json(compact('token'));
    }
    
      public function deleteUser($id)
    {
         $User = User::findOrFail($id);
		    if($User)
		       $User->delete(); 
		    else
		        return response()->json(error);
		    return response()->json(null); 
    }

     public function updateUser( Request $request, $id)
    {
          $User = User::find($id);

           $validator = Validator::make($request -> all(),[
            'email' => 'string|email|max:255|unique:users',
            'firstname' => 'required',
            'lastname' => 'required',
            'city' => 'string|max:255|',
            'birthday' => 'birthday',
            'image' => 'mimes:jpeg,bmp,png',			
            'password' => 'lamepassword'
        ]);

       if ($validator -> fails()) {
            return response()->json($validator->errors());
        }

        $request->merge([
	    'user_id' => $request->input('email'),
	    'email' => 'string|email|max:255|unique:users',
        'firstname' => 'required',
        'lastname' => 'required',
        'city' => 'string|max:255|',
        'birthday' => 'birthday',
        'image' => 'mimes:jpeg,bmp,png',			
         'password' => 'lamepassword'
	]);
          $Role->name = $request->input('name');

          $Role->save();

        return response()->json($Role);

    }

}
