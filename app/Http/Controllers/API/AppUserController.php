<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppUserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

class AppUserController extends Controller
{
//	function __construct(){
//		return $this->middleware('auth:api');
//	}

    //responce data =1 is success ,2 is failed
    public function store(Request $request)
    {
        $storemethodresponse = array();
        $passlength =strlen ($request->password );
        $userdata = AppUser::where('email', $request->email)->first();
        if ($request->firstname == null || $request->lastname == null || $request->email == null || $request->password == null) {
            $storemethodresponse['status'] = 4;
            $storemethodresponse['message'] = "Please fill in all the fields";
            return $storemethodresponse;
        }
        elseif ($passlength<8){
            $storemethodresponse['status'] = 3;
            $storemethodresponse['message'] ="Password length must not be less than 8";
            return $storemethodresponse;
        }

        //$userdata = AppUser::where('email', '=', $request->email)->first();
        elseif($userdata) {
            $storemethodresponse['status'] = 2;
            $storemethodresponse['message'] = "Email already registered";
            return $storemethodresponse;
        } else {
            $password = Hash::make($request->password);
            $appuser=new AppUser;
            $appuser->firstname=$request->firstname;
            $appuser->lastname=$request->lastname;
            $appuser->email=$request->email;
            $appuser->password=$password;
            $appuser->save();
            $storemethodresponse['status'] = 1;
            $storemethodresponse['message'] = "Successfully registered";
            return $storemethodresponse;
            //$appuser = AppUser::create($request->firstname,$request->lastname,$request->email,$password);
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
    public function authenticate(Request $request)
    {
        $storemethodresponse = array();
        $user = AppUser::where('email', $request->email)->first();
        $firstname=$user->firstname;
        $lastname=$user->lastname;
        $email=$user->email;

        if($request->email==null||$request->password==null){
            $storemethodresponse['status'] = 3;
            $storemethodresponse['message'] = "Please fill in the required fields";
            return $storemethodresponse;
        }
        elseif(!$user){
            $storemethodresponse['status'] = 2;
            $storemethodresponse['message'] = "Wrong username or password";
            return $storemethodresponse;
        }
        else {
            $validCredentials = Hash::check($request->password, $user->password);
            $boolvalue = $validCredentials ? 'true' : 'false';
            if ($boolvalue==true) {
                $storedmethodresponse['status'] = 1;
                $storedmethodresponse['firstname'] = $firstname;
                $storedmethodresponse['lastname']= $lastname;
                $storedmethodresponse['email']= $email;
                $storedmethodresponse['message'] = "Login success";
            }
        return $storedmethodresponse;

        }
    }
}
