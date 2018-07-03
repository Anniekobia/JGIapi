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
    public function store(Request $request)
    {
        $appuser = AppUser::create($request->all());
        return new AppUserResource($appuser);
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
}
