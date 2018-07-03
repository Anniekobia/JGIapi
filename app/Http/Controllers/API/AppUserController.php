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
        $appuser = $request->user()->appuser()->create($request->all());
        return new AppUserResource($appuser);
    }

    public function index(Request $request)
    {

        $AppUsers = AppUser::all();
//    	return "No error";
        return AppUserResource::collection($AppUsers);
    }

    public function destroy(Request $request)
    {

    }

    public function update(Request $request, AppUser $appuser)
    {
        if ($request->user()->id !== $appuser->user_id) {
            return response()->json(['error' => 'Unauthorised action'], 401);
        }
        $appuser = appuser()->create($request->all());
        return new AppUserResource($appuser);
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
