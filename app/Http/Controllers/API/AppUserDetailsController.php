<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppUserDetailsController extends Controller
{
    public function update(Request $request)
    {
        $storemethodresponse = array();
        $user = AppUserDetails::where('email', $request->email)->first();

        if($request->email==null){
            $storemethodresponse['status'] = 2;
            //$storedmethodresponce['username']="No name";
            $storemethodresponse['message'] = "Not a user";
            return $storemethodresponse;
        }
        else {
                $storemethodresponse['status'] = 1;
                //$storedmethodresponce['username']= ;
                $storemethodresponse['message'] = "Login success";
            }
            return $storemethodresponse;

        }

}
