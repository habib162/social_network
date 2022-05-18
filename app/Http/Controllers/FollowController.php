<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function create(Request $request){
      
        if($request->personId==Auth::id()){
            return "sorry !! does not follow yourself !!";
        }
        $user_id=Auth::id();
        $check = DB::table('followers')->where('follower_personId',$user_id)
        ->where('followId',$request->personId)->count('id');

        if($check>=1){
            return "Sorry!! already followed!!";
        }


        DB::table('followers')->insert([
            'follower_personId' => Auth::id(),
            'followId' => $request->personId,
            

        ]);
        return 'success';
    }
}
