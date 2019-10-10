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
	Route::get('RoleToUser/{id_role}/{id_user}', 'APIRolesController@RoleToUser');
	// removed role from a user
	Route::get('RemoveRoleToUser/{id_role}/{id_user}', 'APIRolesController@RemoveRoleToUser');


//CRUD Users
	// get All Users
	Route::get('users', 'APIUsersController@getAllUsers');
	// create Users
	Route::post('createuser', 'APIUsersController@createUser');
	// delete Users
	Route::delete('deleteUser/{id}', 'APIUsersController@deleteUser');
	// update Users
	Route::put('updateUser/{id}', 'APIUsersController@updateUser');

//CRUD GYM
	// get All Users
	//Route::get('users', 'APIUsersController@getAllUsers');
	// create Users
	Route::post('createGym', 'APIGymController@createGym');
	// delete Users
	//Route::delete('deleteUser/{id}', 'APIUsersController@deleteUser');
	// update Users
	//Route::put('updateUser/{id}', 'APIUsersController@updateUser');
	