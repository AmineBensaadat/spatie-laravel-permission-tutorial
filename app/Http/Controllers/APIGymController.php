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

    

          public function deleteUser($id)
    {
         $User = User::findOrFail($id);
		    if($User)
		       $User->delete(); 
		    else
		        return response()->json(error);
		    return response()->json(null); 
    }

    public function getAllGymByUserId($id_user){

	$gym = Gym::where('id_user', $id_user)
	               ->orderBy('id', 'desc')
	               ->get();

        return response()->json($gym) ;
    }

     public function getAllGym(){

    $gym = Gym::select('*')
                   ->orderBy('id', 'desc')
                   ->get();

        return response()->json($gym) ;
    }
    // update Gym
         public function updateGym( Request $request, $id){
            $gym = Gym::find($id);


                   $validator = Validator::make($request -> all(),[
                   
                    'name' => 'string',
                    'discription' => 'string',
                    'address' => 'string|max:255|',
                    'city' => 'string',
                    'image' => 'string',            
                ]);

               if ($validator -> fails()) {
                    return response()->json($validator->errors());
                }

               $request->merge([

                    $gym->name = $request->input('name'),
                    $gym->discription = $request->input('discription'),
                    $gym->address = $request->input('address'),
                    $gym->city = $request->input('city'),            
                    $gym->image  = $request->input('image'),
                    $gym->phone = $request->input('phone')
            ]);
            

                  $gym->save();

                return response()->json($gym);

            }
    
}
