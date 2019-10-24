<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\Gym;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use JWTAuth;





class APIUsersController extends Controller
{
    public function getAllUsers($user_id){

     

      $result = User::select('users.*')
      ->where('users.id', '!=', $user_id)->get();
      //Dowload Image
      //return response()->download(public_path('/images/users/002.jpg'), 'User image');


    return $result;
    }
    
    public function createUser(Request $request, $id_user, $id_gym)
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

       $user_created = User::create([

            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'image' => $request->get('image'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('birthday'),
            'cin' => $request->get('cin'),
            'city' => $request->get('city'),
            'phone' => $request->get('phone'),
            'creted_by' => $id_user,
            'adresse' => $request->get('adresse'),
            'statut' => 'active'
        ]);

       // add rolle to user
        $role = Role::findByName('COACH');
        //assigned role ADMIN to user
        $user_created->assignRole($role);

        // insert In coash 
         $coach = array(
          'id_user' => $user_created->id,
          'id_gym' => $id_gym
         );
        DB::table('coach')->insert($coach);


     
        return Response::json($user_created);
    }


    public function usersCreatedBy($user_id){

        $result = User::select('users.*')
      ->where('users.creted_by', '=', $user_id)
       ->where('users.id', '!=', $user_id)
      ->get();

      return response()->json($result);
    }

    public function getAllCoachByGym($id_gym){

        $result = User::select('users.*')
      ->join('coach', 'coach.id_user', '=', 'users.id')
       ->where('coach.id_gym', '=', $id_gym)
      ->get();

      return response()->json($result);
    }

 public function getGymByCoach($id_user){



              $gym = Gym::select('*')
                    ->join('coach', 'coach.id_gym', '=', 'gym.id')
                    ->where('coach.id_user', '=', $id_user)
                   ->get();

      return response()->json($gym);
    }


    
      public function deleteUser($id)
    {
         $User = User::findOrFail($id);
            if($User){
                DB::table('model_has_roles')->where('model_id', '=', $User->id)->delete(); 
               $User->delete();

            }else{
                return response()->json(error);
            }
            return response()->json(null); 
    }

     public function updateUser( Request $request, $id){
  $User = User::find($id);

          $validator = Validator::make($request -> all(),[
           
            'firstname' => 'string',
            'lastname' => 'string',
            'city' => 'string|max:255|',
            'birthday' => 'birthday',
            'password' => 'password'
        ]);

       if ($validator -> fails()) {
            return response()->json($validator->errors());
        }

       $request->merge([

            $User->email = $request->input('email'),
            $User->firstname = $request->input('firstname'),
            $User->lastname = $request->input('lastname'),
            $User->image = $request->input('image'),            
            $User->password  = bcrypt($request->input('password')),
            $User->gender = $request->input('gender'),
            $User->birthday = $request->input('birthday'),
            $User->cin = $request->input('cin'),
            $User->city = $request->input('city'),
            $User->phone = $request->input('phone'),
            $User->adresse = $request->input('adresse')
    ]);
    

          $User->save();

        return response()->json($User);

    }
    
    
public function approveUser($user_id){
        //dd(Permission::get());

        DB::beginTransaction();

    try {
        

        //approve user
            $user = User::find($user_id);
            $user->statut = 'active';
            $user->save();
            $role = Role::findByName('ADMIN');

         //assigned role ADMIN to user
            $user->assignRole($role);

        //assigned all Permission to user
            $permissions = Permission::get();
            $user->syncPermissions($permissions);
            return response()->json($user);


                DB::commit();
                // all good
            } catch (\Exception $e) {
                 DB::rollback();
                // something went wrong
            }


        }


  public function rejecteUser($user_id){

        DB::beginTransaction();

    try {

        //rejecte user
            $user = User::find($user_id);
            $user->statut = 'inactif';
            $user->save();

         //remove all rolle for user

           $user->roles()->detach();

        //reove all Permission to user
            $user->syncPermissions();
            return response()->json($user);


                DB::commit();
                // all good
            } catch (\Exception $e) {
                 DB::rollback();
                // something went wrong
            }


        }




}
