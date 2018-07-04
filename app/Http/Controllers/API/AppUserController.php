<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppUserResource;

class AppUserController extends Controller
{
//	function __construct(){
//		return $this->middleware('auth:api');
//	}

    //responce data =1 is success ,2 is failed
    public function store(Request $request)
    {
        $storemethodresponse = array();
        $userdata = AppUser::where('email', $request->email)->first();
        if ($request->firstname == null || $request->lastname == null || $request->email == null || $request->password == null) {
            $storemethodresponse['status'] = 3;
            $storemethodresponse['message'] = "Please fill in all the fields";
            return $storemethodresponse;
        }
        //$userdata = AppUser::where('email', '=', $request->email)->first();
        elseif($userdata) {
            $storemethodresponse['status'] = 2;
            $storemethodresponse['message'] = "Email already registered";
            return $storemethodresponse;
        } else {
            $appuser = AppUser::create($request->firstname,$request->lastname,$request->email,$request->password);
            $storemethodresponse['status'] = 1;
            $storemethodresponse['message'] = "Successfully registered";
            return $storemethodresponse;
        }

//        return new AppUserResource($userdata);
//        $appuser = AppUser::create($request->all());
        //return new AppUserResource($appuser);
        //return $appuser;
    }

    public function index()
    {

        $AppUsers = AppUser::all();
//    	return "No error";
        return AppUserResource::collection($AppUsers);
    }

    public function destroy(Request $request,$userid)
    {
        $userdata = AppUser::find($userid);
        $userdata ->delete($request->all());
        return new AppUserResource($userdata);
        //TODO not make delete work
    }

    public function update(Request $request, $userid)
    {
        $userdata = AppUser::find($userid);
        $userdata ->update($request->all());
        return new AppUserResource($userdata);

        //TODO not make update work
    }
    public function show($userid)
    {
        $userdata = AppUser::find($userid);
        if (!$userdata) {
            return "User not found";
        }
        return new AppUserResource($userdata);
    }
    public function loginstore(Request $request){
        $storemethodresponse = array();
        $userdata = AppUser::where('email', $request->email)->first();
        $validate =
        if ($userdata){
            $storemethodresponse['status'] = 1;
            $storemethodresponse['message'] = "Logged in";
        }
        elseif(){
            $storemethodresponse['status'] = 2;
            $storemethodresponse['message'] = "Wrong Email address";
        }
    }
}
