<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($userId , $roleName)
    {
        //Permission::create(['name' => 'edit post']);

        // ceate a role 
        //Role::create(['name' => 'ADMIN']);
       /* $role = Role::findById(1);

        // create permission 
        $permission = Permission::findById(2);

        // connect rolle and permission
        $role->givePermissionTo($permission);
        $permission->assignRole($role);*/
        //var_dump($role);
        //auth()->user()->assignRole('writer');
        //auth()->user()->givePermissionTo('edit post');

        // delete role
        //$role = Role::findById(1);
        //$role->delete();
        $user = User::find($userId);

        
        $role = Role::findByName($roleName);
        //dd($role);
        $user->assignRole($role);

        return $role;

        //return auth()->user()->removeRole('writer');

        //return User::permission('edit post')->get();

        //return view('home');
    }
}
