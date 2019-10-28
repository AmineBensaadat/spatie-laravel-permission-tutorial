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
	// get All Coach By Gym
	Route::get('getAllCoachByGym/{id_gym}', 'APIUsersController@getAllCoachByGym');
	// create gym by coach
	Route::get('getGymByCoach/{id_user}', 'APIUsersController@getGymByCoach');
	// create Users
	Route::post('createuser/{id_user}/{id_gym}', 'APIUsersController@createUser');
	// delete Users
	Route::delete('deleteUser/{id}', 'APIUsersController@deleteUser');
	// update Users
	Route::put('updateUser/{id}', 'APIUsersController@updateUser');
	// approve user
	Route::get('approveUser/{user_id}', 'APIUsersController@approveUser');
	// rejecte user
	Route::get('rejecteUser/{user_id}', 'APIUsersController@rejecteUser');

//CRUD GYM
	// get All Gym by ID USER
	Route::get('getAllGymByUserId/{id_user}', 'APIGymController@getAllGymByUserId');
	// get All Gym 
	Route::get('getAllGym', 'APIGymController@getAllGym');
	// create Gym
	Route::post('createGym', 'APIGymController@createGym');
	// delete Gym
	//Route::delete('deleteUser/{id}', 'APIUsersController@deleteUser');
	// update Gym
	Route::put('updateGym/{id}', 'APIGymController@updateGym');


//CRUD Subscription
	// get All Subscription By Gym
	Route::get('getAllSubscriptionById_gym/{id_gym}', 'APISubscriptionController@getAllSubscriptionById_gym');
	// get All Subscription
	Route::get('getAllSubscription', 'APISubscriptionController@getAllSubscription');
	// create Subscription
	  Route::post('createSubscription', 'APISubscriptionController@createSubscription');
	// delete Subscription
	Route::delete('deleteSubscription/{id_Subscription}', 'APISubscriptionController@deleteSubscription');
	// update Subscription
	Route::put('updateSubscription/{id_Subscription}', 'APISubscriptionController@updateSubscription');

	
//CRUD Members
	// get All Members By Gym
	Route::get('getAllMembersById_gym/{id_gym}', 'APIMemberController@getAllMembersById_gym');
	// get All Members
	Route::get('getAllMembers', 'APIMemberController@getAllMembers');

	// get Single Member
	Route::get('getSingleMembersById/{id}', 'APIMemberController@getSingleMembersById');
	// create Member
	Route::post('createMember', 'APIMemberController@createMember');
	// delete Subscription
	//Route::delete('deleteSubscription/{id_Subscription}', 'APISubscriptionController@deleteSubscription');
	// update Subscription
	//Route::put('updateSubscription/{id_Subscription}', 'APISubscriptionController@updateSubscription');
	
//CRUD Payment History
	// get All Payment History By id member
	Route::get('getAllPayment_historyBymember/{id_member}', 'APIPayment_historyController@getAllPayment_historyBymember');
	// get All Members
	//Route::get('getAllMembers', 'APIMemberController@getAllMembers');
	// create Member
	//Route::post('createMember', 'APIMemberController@createMember');
	// delete Subscription
	//Route::delete('deleteSubscription/{id_Subscription}', 'APISubscriptionController@deleteSubscription');
	// update Subscription
	//Route::put('updateSubscription/{id_Subscription}', 'APISubscriptionController@updateSubscription');
	