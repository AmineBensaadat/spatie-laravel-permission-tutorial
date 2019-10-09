<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class APIPermissionController extends Controller
{
    public function getAllPermissions(){

      return Permission::get();
    }
    
    public function createPermission(Request $request)
    {
            $request->validate([
            'name' => 'required' 
        ]);

        $Permission = Permission::create($request->all());

         return response()->json($Permission);
    }
    
      public function deletePermission($id)
    {
         $Permission = Permission::findOrFail($id);
        if($Permission)
           $Permission->delete(); 
        else
            return response()->json(error);
        return response()->json(null); 
    }
    
         public function updatePermission( Request $request, $id)
    {
          $Permission = Permission::find($id);
          $Permission->name = $request->input('name');

          $Permission->save();

        return response()->json($Permission);

    }
    
     // assigned permission to Role
     public function PermissionToRole( Request $request)
    {     
           $role = Role::findById($request->input('id_role'));
           $permission = Permission::findById($request->input('id_prmission'));
           $permission->assignRole($role);

        return response()->json($permission);

    }

    // assigned permission to User
     public function PermissionToUser( Request $request)
    {     
           $user = User::find($request->input('id_user'));
           $permission = Permission::findById($request->input('id_prmission'));
           $user->givePermissionTo($permission);

        return response()->json($permission);

    }

     // revoked from a user
     public function RevokePermissionToUser( Request $request)
    {     
           $user = User::find($request->input('id_user'));        
           $permission = Permission::findById($request->input('id_prmission'));
           $user->revokePermissionTo($permission);
        return response()->json($permission);

    }
}
