<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppUserDetailsController extends Controller
{
    public function update(Request $request, $userid)
    {
        $userdata = AppUser::find($userid);
        $userdata ->update($request->all());
        return new AppUserResource($userdata);

        //TODO not make update work
    }

}
