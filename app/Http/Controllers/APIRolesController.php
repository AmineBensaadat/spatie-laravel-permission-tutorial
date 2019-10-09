<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use App\Http\Controllers\DB;

class APIRolesController extends Controller
{
    public function getAllRoles(){

      $roles = \Spatie\Permission\Models\Role::all();

    	return $roles;
    }
    
    public function createRole(Request $request)
    {
            $request->validate([
            'name' => 'required' 
        ]);

        $Role = Role::create($request->all());

         return response()->json($Role);
    }
    
      public function deleteRole($id)
    {
         $Role = Role::findOrFail($id);
		    if($Role)
		       $Role->delete(); 
		    else
		        return response()->json(error);
		    return response()->json(null); 
    }

     public function updateRole( Request $request, $id)
    {
          $Role = Role::find($id);
          $Role->name = $request->input('name');

          $Role->save();

        return response()->json($Role);

    }

    // assigned Role to User
     public function RoleToUser($id_role, $id_user)
    {     
           $role = Role::findById($id_role);
           $user = User::find($id_user);
           $user->assignRole($role);

        return response()->json($user);

    }

        // assigned Role to User
     public function RemoveRoleToUser($id_role, $id_user)
    {     
           $role = Role::findById($id_role);
           $user = User::find($id_user);
           $user->removeRole($role);
           
        return response()->json($user);

    }
}
