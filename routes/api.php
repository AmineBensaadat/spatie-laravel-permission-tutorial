<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Register   
Route::post('user/register', 'APIRegisterController@register');
// Login
Route::post('user/login', 'APILoginController@login');

//CRUD Permission
	//get All Permissions
	Route::get('permissions', 'APIPermissionController@getAllPermissions');
	// create Permission
	Route::post('createPermission', 'APIPermissionController@createPermission');
	// delete Permission
	Route::delete('deletePermission/{id}', 'APIPermissionController@deletePermission');
	// updatePermission
	Route::put('updatePermission/{id}', 'APIPermissionController@updatePermission');
	// assigned permission to Role
	Route::post('PermissionToRole', 'APIPermissionController@PermissionToRole');
	// assigned permission to User
	Route::post('PermissionToUser', 'APIPermissionController@PermissionToUser');
	// revoked from a user
	Route::post('RevokePermissionToUser', 'APIPermissionController@RevokePermissionToUser');


//CRUD Roles
	// get All Roles
	Route::get('roles', 'APIRolesController@getAllRoles');
	// create Role
	Route::post('createrole', 'APIRolesController@createRole');
	// delete Role
	Route::delete('deleterole/{id}', 'APIRolesController@deleteRole');
	// update Role
	Route::put('updateRole/{id}', 'APIRolesController@updateRole');
	// assigned Role to user
	Route::post('RoleToUser', 'APIRolesController@RoleToUser');
	// removed role from a user
	Route::post('RemoveRoleToUser', 'APIRolesController@RemoveRoleToUser');


//CRUD Users
	// get All Roles
	Route::get('users', 'APIUsersController@getAllUsers');
	// create Role
	Route::post('createuser', 'APIUsersController@createUser');
	// delete Role
	Route::delete('deleteUser/{id}', 'APIUsersController@deleteUser');
	// update Role
	Route::put('updateUser/{id}', 'APIUsersController@updateUser');
	