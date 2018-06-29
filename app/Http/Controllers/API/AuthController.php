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

    	$user=new User(); 
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->password=bcrypt($request->password);
    	$user->save();

    	$http = new Client;

		$response = $http->post('http://jgiapi.herokuapp.com/oauth/token', [
		    'form_params' => [
		        'grant_type' => 'password',
		        'client_id' => '2',
		        'client_secret' => '3qE6d37k202lGglPrIY01SxRq2YGjk9rrviJoPUV',
		        'username' => $request->email,
		        'password' => $request->password,
		        'scope' => '',
		    ],
		]);
		return response(['data'=>json_decode((string) $response->getBody(), true)]);
    }
    public function login(Request $request){
    	
    }
}

