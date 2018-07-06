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
            $age=$request->age;
            $gender=$request->gender;
            $weight=$request->weight;
            $weightgoal=$request->weightgoal;
            $homegym=$request->homegym;

            $userdetails->user_id = $user->id;
            $userdetails->age = $age;
            $userdetails->gender = $gender;
            $userdetails->weight = $weight;
            $userdetails->weight_goal = $weightgoal;
            $userdetails->home_gym_location = $homegym;
            $userdetails->save();
            $storemethodresponse['status']=1;
            $storemethodresponse['age']=$age;
            $storemethodresponse['gender']=$gender;
            $storemethodresponse['weight']=$weight;
            $storemethodresponse['weightgoal']=$weightgoal;
            $storemethodresponse['homegym']=$homegym;
            return $storemethodresponse;
        }else if($user){
            $userdetails=new AppUserDetails;
            $age=$request->age;
            $gender=$request->gender;
            $weight=$request->weight;
            $weightgoal=$request->weightgoal;
            $homegym=$request->homegym;

            $userdetails->user_id = $user->id;
            $userdetails->age = $age;
            $userdetails->gender = $gender;
            $userdetails->weight = $weight;
            $userdetails->weight_goal = $weightgoal;
            $userdetails->home_gym_location = $homegym;
            $userdetails->save();
            $storemethodresponse['status']=1;
            $storemethodresponse['age']=$age;
            $storemethodresponse['gender']=$gender;
            $storemethodresponse['weight']=$weight;
            $storemethodresponse['weightgoal']=$weightgoal;
            $storemethodresponse['homegym']=$homegym;
            return $storemethodresponse;
        }
    }
}
