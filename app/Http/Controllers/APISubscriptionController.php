<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Subscription;

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
}
