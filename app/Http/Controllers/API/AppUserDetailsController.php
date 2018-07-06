<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\AppUserDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppUserDetailsController extends Controller
{
    public function updateuserdetails(Request $request)
    {
        $storemethodresponse = array();
        $user = AppUser::where('email', $request->email)->first();

        if ($request->age==null||$request->gender==null||$request->weight==null||$request->weight_goal==null||$request->home_gym_location){
            $userdetails=new AppUserDetails;
            $userdetails->user_id = $user->id;
            $userdetails->age = $request->age;
            $userdetails->gender = $request->gender;
            $userdetails->weight = $request->weight;
            $userdetails->weight_goal = $request->weightgoal;
            $userdetails->home_gym_location = $request->homegymlocation;
            $userdetails->save();
            $storemethodresponse['status']=1;
            $storemethodresponse['message']="Successfully updated";
            return $storemethodresponse;
        }else if($user){
            $userdetails=new AppUserDetails;
            $userdetails->user_id = $user->id;
            $userdetails->age = $request->age;
            $userdetails->gender = $request->gender;
            $userdetails->weight = $request->weight;
            $userdetails->weight_goal = $request->weightgoal;
            $userdetails->home_gym_location = $request->homegymlocation;
            $userdetails->save();
            $storemethodresponse['status']=1;
            $storemethodresponse['message']="Succesfully added";
            return $storemethodresponse;
        }
    }
}
