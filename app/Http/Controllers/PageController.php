<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function create(Request $request){

        $validated = $request->validate([
            'page_name' => 'required|max:55',
        ]);

        DB::table('pages')->insert([
            'page_name' => $request->page_name,
            'personId' => Auth::id(),

        ]);
        return 'success';
    }


    public function followpage(Request $request){

       $a= DB::table('followers')->select('pageId');
        if($request->pageId==$a){
            return "sorry !! does not follow yourself !!";
        }
        $user_id=Auth::id();
        $check = DB::table('followers')->where('follower_personId',$user_id)
        ->where('pageId',$request->pageId)->count('id');

        if($check>=1){
            return "Sorry!! already followed!!";
        }


        DB::table('followers')->insert([
            'follower_personId' => Auth::id(),
            'pageId' => $request->pageId,
           
            

        ]);
        return  "success";
    }
}
