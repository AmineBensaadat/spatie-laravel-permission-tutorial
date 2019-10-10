<?php

namespace App\Http\Controllers;
use App\Gym;
use Illuminate\Http\Request;
use App\User; 
use App\Http\Controllers\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Response;
use Validator;
use JWTAuth;



class APIGymController extends Controller
{

     public function createGym(Request $request)
    {
    	
           $validator = Validator::make($request -> all(),[
            'name' => 'required',
            'id_user' => 'integer',
            
        ]);


        if ($validator -> fails()) {
            return response()->json($validator->errors());
        }

        $Gym = Gym::create([

            'name' => $request->get('name'),
            'id_user' => $request->get('id_user'),
            'discription' => $request->get('discription'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'image' => $request->get('image'),
            'phone' => $request->get('phone')
            
        ]);

       

         return response()->json($Gym);
    }
    
}
