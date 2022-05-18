<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller

{  
    public function create(Request $request){
    DB::table('posts')->insert([
        'post_content' => $request->post_content,
        'personId' => Auth::id(),

    ]);
    return 'success';
}

public function pagepost(Request $request){
    DB::table('posts')->insert([
        'post_content' => $request->post_content,
        'pageId' => $request->pageId,

    ]);
    return 'success';
}
}
