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
}
