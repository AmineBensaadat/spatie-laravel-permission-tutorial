<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Subscription;
use Response;
use DB;
use Validator;

class APISubscriptionController extends Controller
{
     public function createSubscription(Request $request)
    {
            $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'integer'

        ]);

        $Subscription = Subscription::create($request->all());

         return response()->json($Subscription);
    }


     public function getAllSubscriptionById_gym($id_gym){

     

      $result = Subscription::select('subscription_gym.*')
      ->where('id_gym', '=', $id_gym)->get();
      

    return response()->json($result);
    }

    public function getAllSubscription(){
      $result = Subscription::select('subscription_gym.*')
     ->get();
      

    return response()->json($result);
    }


      public function deleteSubscription($id_Subscription)
    {
         $Subscription = Subscription::find($id_Subscription);
            if($Subscription){
               $deleted = DB::table('subscription_gym')->delete($id_Subscription); 
            }else{
                return response()->json('error');
            }
            return response()->json($deleted); 
    }


    public function updateSubscription(Request $request, $id_Subscription){
		  $Subscription = Subscription::find($id_Subscription);

		           $validator = Validator::make($request -> all(),[
		           
		            'name' => 'string|max:255',
		            'price' => 'integer'
		        ]);

		       if ($validator -> fails()) {
		            return response()->json($validator->errors());
		        }

		        $request->merge([
		            $Subscription->name = $request->input('name'),
		            $Subscription->price = $request->input('price')
		    ]);
		    

		          $Subscription->save();

		        return response()->json($Subscription);

		    }
    

}
