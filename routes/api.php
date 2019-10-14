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
	// assigned permissions to User
	Route::get('PermissionsToUser/{user_id}/{listPermission}', 'APIPermissionController@PermissionsToUser');
	// assigned permission to User
	Route::post('PermissionToUser', 'APIPermissionController@PermissionToUser');
	// revoked from a user
	Route::post('RevokePermissionToUser', 'APIPermissionController@RevokePermissionToUser');


//CRUD Roles
	// get All Roles
	Route::get('roles', 'APIRolesController@getAllRoles');
	// get All Roles expect Super ADMIN
	Route::get('rolesExceptSuper', 'APIRolesController@rolesExceptSuper');
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
	Route::get('users/{user_id}', 'APIUsersController@getAllUsers');
	// get All Users creted By
	Route::get('usersCreatedBy/{user_id}', 'APIUsersController@usersCreatedBy');
	// create Users
	Route::post('createuser/{id_user}', 'APIUsersController@createUser');
	// delete Users
	Route::delete('deleteUser/{id}', 'APIUsersController@deleteUser');
	// update Users
	Route::put('updateUser/{id}', 'APIUsersController@updateUser');
	// approve user
	Route::get('approveUser/{user_id}', 'APIUsersController@approveUser');


//CRUD GYM
	// get All Gym
	Route::get('getAllGymByUserId/{id_user}', 'APIGymController@getAllGymByUserId');
	// create Gym
	Route::post('createGym', 'APIGymController@createGym');
	// delete Gym
	//Route::delete('deleteUser/{id}', 'APIUsersController@deleteUser');
	// update Gym
	//Route::put('updateUser/{id}', 'APIUsersController@updateUser');


//CRUD Subscription
	// get All Subscription
	Route::get('getAllSubscriptionById_gym/{id_gym}', 'APISubscriptionController@getAllSubscriptionById_gym');
	// create Subscription
	Route::post('createSubscription', 'APISubscriptionController@createSubscription');
	// delete Subscription
	//Route::delete('deleteUser/{id}', 'APIUsersController@deleteUser');
	// update Subscription
	//Route::put('updateUser/{id}', 'APIUsersController@updateUser');
	