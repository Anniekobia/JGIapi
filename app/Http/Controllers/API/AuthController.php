<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;	

class AuthController extends Controller
{
    //
    public function register(Request $request){
    	$request->validate([
    		'email'=>'required',
    		'name'=>'required',
    		'password'=>'required']);

    	$user=User::firstOrNew(['email' =>$request->email]); 
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->password=bcrypt($request->password);
    	$user->save();

    	$http = new Client;
    	
		$response = $http->post(url('oauth/token'), [
		    'form_params' => [
		        'grant_type' => 'password',
		        'client_id' => '6',
		        'client_secret' => '3bre0nWOdpgh6unzxNLye5ZCSIug1lW9dq302gD3',
		        'username' => $request->email,
		        'password' => $request->password,
		        'scope' => '',
		    ],
		]);

		return response(['data'=>json_decode((string) $response->getBody(), true)]);
    }
    // public function login(Request $request){
    //     $request->validate([
    //         'email'=>'required',
    //         'password'=>'required']);

    //     $user=User::where('email'=>$request->email)->first();
    // 	if (!$user) {
    //         return response(['status'=>'error','message'=>'User not found']);
    //     }
    // }
}

